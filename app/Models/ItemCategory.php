<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;
    protected $fillable=[
        'item_category_name'
       
    ];
    public function supplyItem ()
    {
        return $this->hasMany(SupplyItem::class, 'item_category_id');
    }
}
