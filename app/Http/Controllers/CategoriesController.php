<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search') ?? '';
        $categories = Category::latest()
            ->when($search, function (Builder $builder) use ($search) {
                $builder->where('title', 'like', '%' . $search . '%');
            })
            ->paginate(20);
        return view('categories.index', compact('categories', 'search'));
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(CategoriesRequest $request): RedirectResponse
    {
        Category::create([
            'title' => $request->get('title'),
        ]);
        return redirect()->route('admin.categories.index')->with('message', 'Category created');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoriesRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->only('title'));
        return redirect()->route('admin.categories.index')->with('message', 'Category updated');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->back()->with('message', 'Category deleted');
    }
}
