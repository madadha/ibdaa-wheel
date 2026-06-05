<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WheelItem extends Model
{
    protected $fillable = [
        'category_id',
        'title_ar',
        'title_he',
        'description_ar',
        'description_he',
        'question_ar',
        'question_he',
        'icon',
        'sort_order',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}