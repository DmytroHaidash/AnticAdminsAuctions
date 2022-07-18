<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Category::create([
            'title' => $request->get('title'),
        ]);
        return redirect()->route('admin.category.index')->with('message', 'Category created');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($request->only('title'));
        return redirect()->route('admin.category.idex')->with('message', 'Category updated');
    }

    public function destroy(Category $category):RedirectResponse
    {
        $category->delete();
        return redirect()->route('categories.index')->with('message', 'Category deleted');
    }
}
