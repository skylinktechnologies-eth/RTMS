<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyOrderItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'item_id',
        'supply_order_id',
        'quantity',
        'price',
        'total'
    ];
    public function supplyOrder()
    {
        return $this->belongsTo(SupplyOrder::class, 'supply_order_id');
    }

}
