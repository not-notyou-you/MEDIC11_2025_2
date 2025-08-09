<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Service;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        return view('pages.category.index', [
            'title' => 'Categories',
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
            'categories' => Category::paginate(10)
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('category.index')->with('status', 'New category has been added!');
    }

    public function edit(Category $category)
    {
        return view('pages.category.edit', [
            'title' => $category->name,
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get(),
            'category' => $category
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->route('category.index')->with('status', $category->name . ' has been updated!');
    }

    public function destroy(Category $category)
    {
        // Hapus semua gambar terkait category ini
        foreach ($category->galleries as $gallery) {
            $filePath = str_replace('storage/', 'public/', $gallery->path);
            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        // Hapus record gallery dari database
        $category->galleries()->delete();

        // Hapus category
        $category->delete();

        return redirect()->route('category.index')->with('status', $category->name . ' and all related photos have been deleted!');
    }
}