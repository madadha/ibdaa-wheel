<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'title_he' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:20'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        Category::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تمت إضافة المجال بنجاح.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'title_ar' => ['required', 'string', 'max:255'],
            'title_he' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:20'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $category->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم تعديل المجال بنجاح.');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'تم حذف المجال وجميع الخانات التابعة له.');
    }
}