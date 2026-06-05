<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\WheelItem;
use Illuminate\Http\Request;

class AdminWheelItemController extends Controller
{
    public function index()
    {
        $items = WheelItem::with('category')
            ->orderBy('category_id')
            ->orderBy('sort_order')
            ->get();

        return view('admin.wheel-items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.wheel-items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_he' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_he' => ['nullable', 'string'],
            'question_ar' => ['nullable', 'string'],
            'question_he' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        WheelItem::create($validated);

        return redirect()
            ->route('admin.wheel-items.index')
            ->with('success', 'تمت إضافة الخانة بنجاح.');
    }

    public function edit(WheelItem $wheelItem)
    {
        $categories = Category::orderBy('sort_order')->get();

        return view('admin.wheel-items.edit', [
            'item' => $wheelItem,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, WheelItem $wheelItem)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title_ar' => ['required', 'string', 'max:255'],
            'title_he' => ['required', 'string', 'max:255'],
            'description_ar' => ['nullable', 'string'],
            'description_he' => ['nullable', 'string'],
            'question_ar' => ['nullable', 'string'],
            'question_he' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $wheelItem->update($validated);

        return redirect()
            ->route('admin.wheel-items.index')
            ->with('success', 'تم تعديل الخانة بنجاح.');
    }

    public function destroy(WheelItem $wheelItem)
    {
        $wheelItem->delete();

        return redirect()
            ->route('admin.wheel-items.index')
            ->with('success', 'تم حذف الخانة بنجاح.');
    }
}