<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\ActivityLog;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $categories = Category::withCount('items')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('categories.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create($request->validated());

        ActivityLog::record(
            auth()->id(),
            'create_category',
            "Menambahkan kategori baru: '{$category->name}'."
        );

        return redirect()->route('categories.index')
            ->with('success', 'Kategori barang berhasil ditambahkan!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $oldName = $category->name;
        $category->update($request->validated());

        ActivityLog::record(
            auth()->id(),
            'update_category',
            "Mengubah nama kategori dari '{$oldName}' menjadi '{$category->name}'."
        );

        return redirect()->route('categories.index')
            ->with('success', 'Kategori barang berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        if ($category->items()->count() > 0) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih memiliki barang terdaftar!');
        }

        $name = $category->name;
        $category->delete();

        ActivityLog::record(
            auth()->id(),
            'delete_category',
            "Menghapus kategori barang: '{$name}'."
        );

        return redirect()->route('categories.index')
            ->with('success', 'Kategori barang berhasil dihapus!');
    }
}
