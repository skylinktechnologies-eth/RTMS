<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenInteraction extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_item_id',
        'interaction_type',
        'interaction_date'
    ];
    public function OrderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item_id');
    }

}
