<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);

        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $tkdnTypes = Category::getTkdnTypes();

        return view('category.create', compact('tkdnTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code',
            'tkdn_type' => 'required|in:tkdn_jasa,tkdn_barang_jasa',
        ]);
        Category::create($validated);

        return redirect()->route('master.category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $tkdnTypes = Category::getTkdnTypes();

        return view('category.edit', compact('category', 'tkdnTypes'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:categories,code,'.$category->id.',id',
            'tkdn_type' => 'required|in:tkdn_jasa,tkdn_barang_jasa',
        ]);
        $category->update($validated);

        return redirect()->route('master.category.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('master.category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
