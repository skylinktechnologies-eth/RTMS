<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable=[
            'category_id',
            'item_name',
            'image',
            'price'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
