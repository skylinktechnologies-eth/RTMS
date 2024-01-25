<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable=[
        'item_name',
        'category',
        'unit_of_measure',
        'price'
    ];
    public function itemCategory()
    {
        return $this->belongsTo(ItemCategory::class, 'item_category_id');
    }
    public function supplyOrderItem()
    {
        return $this->hasMany(SupplyOrderItem::class, 'item_id');
    }
    public function issuingItem()
    {
        return $this->hasMany(IssuingItem::class, 'item_id');
    }
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'item_id');
    }
}
