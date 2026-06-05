<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title_ar',
        'title_he',
        'color',
        'sort_order',
        'is_active',
    ];

    public function wheelItems()
    {
        return $this->hasMany(WheelItem::class);
    }
}