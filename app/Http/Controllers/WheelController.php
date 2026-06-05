<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\WheelItem;

class WheelController extends Controller
{
    public function show($lang)
    {
        if (!in_array($lang, ['ar', 'he'])) {
            abort(404);
        }

        $categories = Category::where('is_active', true)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($category) use ($lang) {
                return [
                    'id' => $category->id,
                    'title' => $lang === 'he' ? $category->title_he : $category->title_ar,
                    'color' => $category->color,
                ];
            });

        $items = WheelItem::with('category')
            ->where('is_active', true)
            ->whereHas('category', function ($query) {
                $query->where('is_active', true);
            })
            ->orderBy('category_id')
            ->orderBy('sort_order')
            ->get()
            ->map(function ($item) use ($lang) {
                return [
                    'id' => $item->id,
                    'title' => $lang === 'he' ? $item->title_he : $item->title_ar,
                    'description' => $lang === 'he' ? $item->description_he : $item->description_ar,
                    'question' => $lang === 'he' ? $item->question_he : $item->question_ar,
                    'category' => $lang === 'he' ? $item->category->title_he : $item->category->title_ar,
                    'category_id' => $item->category_id,
                    'color' => $item->category->color,
                ];
            });

        $texts = [
            'ar' => [
                'html_lang' => 'ar',
                'dir' => 'rtl',
                'page_title' => 'عجلة التمكين',
                'school' => 'مدرسة إبداع التكنولوجية – بير المكسور',
                'subtitle' => 'لف العجلة واكتشف قيمة تربوية للتفكير والتطبيق',
                'spin' => 'لف العجلة',
                'again' => 'لف مرة أخرى',
                'close' => 'إغلاق',
                'category' => 'المجال',
                'question' => 'سؤال للتفكير',
                'empty' => 'لا توجد خانات مفعّلة حاليًا.',
                'switch_lang' => 'עברית',
                'switch_url' => url('/he'),
                'logo_url' => 'http://ibdaatechedu.com/wp-content/uploads/2026/01/شعار-مدرسة-إبداع-التكنولوجية-–-بير-المكسور.png',
            ],
            'he' => [
                'html_lang' => 'he',
                'dir' => 'rtl',
                'page_title' => 'גלגל ההעצמה',
                'school' => 'בית הספר הטכנולוגי איבדאע – ביר אלמכסור',
                'subtitle' => 'סובבו את הגלגל וגלו ערך חינוכי לחשיבה וליישום',
                'spin' => 'סובב את הגלגל',
                'again' => 'סובב שוב',
                'close' => 'סגור',
                'category' => 'תחום',
                'question' => 'שאלה למחשבה',
                'empty' => 'אין כרגע פריטים פעילים.',
                'switch_lang' => 'العربية',
                'switch_url' => url('/ar'),
                'logo_url' => 'http://ibdaatechedu.com/wp-content/uploads/2026/01/شعار-مدرسة-إبداع-التكنولوجية-–-بير-المكسور.png',
            ],
        ];

        return view('wheel.show', [
            'lang' => $lang,
            'categories' => $categories,
            'items' => $items,
            'texts' => $texts[$lang],
        ]);
    }
}