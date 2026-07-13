<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    private $imageManager;

    public function __construct()
    {
        // Initialize Intervention Image with GD driver
        $this->imageManager = new ImageManager(new Driver());
    }

    public function index(Request $request)
    {
        $category = null;

        if ($request->has('category')) {
            $categorySlug = $request->query('category');
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $galleries = Gallery::where('category_id', $category->id)->get();
        } else {
            $galleries = Gallery::all();
        }

        return view('pages.gallery.index', [
            'title' => 'Gallery',
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
            'galleries' => $galleries,
            'categories' => Category::all(),
            'currentCategory' => $category
        ]);
    }

    public function create()
    {
        return view('pages.gallery.create', [
            'title' => 'Create Gallery',
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
            'categories' => Category::all()
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,bmp,svg,webp|max:20000',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id'
        ], [
            'images.*.max' => 'Ukuran file gambar tidak boleh lebih dari :max 20 MB',
            'images.*.mimes' => 'Format file harus gambar yang valid',
        ]);

        if ($request->hasFile('images')) {
            $category = Category::find($request->category_id);
            $categoryName = $category->name;
            $storagePath = 'public/uploads/' . $categoryName;

            // Ensure directory exists
            if (!Storage::exists($storagePath)) {
                Storage::makeDirectory($storagePath);
            }

            foreach ($request->file('images') as $image) {
                // Generate unique filename dengan ekstensi .webp
                $filename = time() . '_' . Str::random(10) . '.webp';
                
                try {
                    // Konversi gambar ke WebP menggunakan Intervention Image
                    $imageData = $this->imageManager->read($image->getRealPath());
                    
                    // Encode ke WebP dengan kualitas 80%
                    $webpImage = $imageData->toWebp(80);
                    
                    // Simpan gambar WebP ke storage
                    $filePath = $storagePath . '/' . $filename;
                    Storage::put($filePath, $webpImage);
                    
                    // Path untuk database (menggunakan storage/)
                    $dbPath = str_replace('public/', 'storage/', $filePath);

                    Gallery::create([
                        'user_id' => $request->user_id,
                        'category_id' => $request->category_id,
                        'title' => $request->title,
                        'path' => $dbPath,
                    ]);
                } catch (\Exception $e) {
                    // Log error dan continue dengan gambar berikutnya
                    Log::error('Image conversion failed: ' . $e->getMessage());
                    continue;
                }
            }
        }

        return redirect()->route('gallery.index')->with('status', 'Images uploaded successfully and converted to WebP');
    }

    public function user_show(Category $category)
    {
        $previousCategory = Category::where('id', '<', $category->id)->orderBy('id', 'desc')->first();
        $nextCategory = Category::where('id', '>', $category->id)->orderBy('id', 'asc')->first();

        return view('pages.gallery.user_show', [
            'title' => $category->name,
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
            'galleries' => $category->galleries,
            'categories' => Category::all(),
            'currentCategory' => $category,
            'previousCategory' => $previousCategory,
            'nextCategory' => $nextCategory,
        ]); 
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        $filePath = str_replace('storage/', 'public/', $gallery->path);
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }

        $gallery->delete();

        return redirect()->back()->with('status', 'Image deleted successfully');
    }

    public function user_index()
    {
        return view('pages.gallery.user_index', [
            'title' => 'Gallery',
            'categories' => Category::all()
        ]);
    }

    public function showImage(Category $category, $imageId)
    {
        $image = Gallery::findOrFail($imageId);
        $previousImage = Gallery::where('category_id', $category->id)
                          ->where('id', '<', $image->id)
                          ->orderBy('id', 'desc')
                          ->first();
        $nextImage = Gallery::where('category_id', $category->id)
                       ->where('id', '>', $image->id)
                       ->orderBy('id', 'asc')
                       ->first();

        return view('pages.gallery.show_image', [
            'title' => $image->title,
            'image' => $image,
            'category' => $category,
            'previousImage' => $previousImage,
            'nextImage' => $nextImage,
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get()
        ]);
    }

    /**
     * Download gambar dengan konversi ke PNG
     */
    public function download($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        // Path file asli di storage
        $originalPath = str_replace('storage/', 'public/', $gallery->path);
        
        if (!Storage::exists($originalPath)) {
            return redirect()->back()->with('error', 'File not found');
        }

        try {
            // Baca file WebP
            $webpContent = Storage::get($originalPath);
            
            // Konversi WebP ke PNG menggunakan Intervention Image
            $imageData = $this->imageManager->read($webpContent);
            $pngContent = $imageData->toPng();
            
            // Generate nama file untuk download
            $downloadFilename = Str::slug($gallery->title) . '.png';
            
            // Return response download dengan konversi real-time
            return response()->streamDownload(function () use ($pngContent) {
                echo $pngContent;
            }, $downloadFilename, [
                'Content-Type' => 'image/png',
                'Content-Disposition' => 'attachment; filename="' . $downloadFilename . '"'
            ]);
        } catch (\Exception $e) {
            Log::error('Image download conversion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to convert image for download');
        }
    }
}