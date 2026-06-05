<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\WheelItem;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'categoriesCount' => Category::count(),
            'itemsCount' => WheelItem::count(),
            'activeCategoriesCount' => Category::where('is_active', true)->count(),
            'activeItemsCount' => WheelItem::where('is_active', true)->count(),
        ]);
    }
}