<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
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
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:20000',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id'
        ], [
            'images.*.max' => 'Ukuran file gambar tidak boleh lebih dari :max 20 MB',
            'images.*.mimes' => 'Format file harus jpeg, png, jpg, atau webp',
        ]
    );
    
        if ($request->hasFile('images')) {
            $category = Category::find($request->category_id);
            $categoryName = $category->name;
            $storagePath = 'public/uploads/' . $categoryName;
    
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . $image->getClientOriginalName();
                $filePath = $image->storeAs($storagePath, $filename);
                $dbPath = str_replace('public/', 'storage/', $filePath);
    
                Gallery::create([
                    'user_id' => $request->user_id,
                    'category_id' => $request->category_id,
                    'title' => $request->title,
                    'path' => $dbPath,
                ]);
            }
        }
    
        return redirect()->route('gallery.index')->with('status', 'Images uploaded successfully');
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
            // 'galleries' => Gallery::where('user_id', Auth::id())->get(),
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
}
