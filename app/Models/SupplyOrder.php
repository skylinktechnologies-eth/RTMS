<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyOrder extends Model
{
    use HasFactory;
    protected $fillable=[
        'supplier_id',
        'order_date',
        'status'
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function orderItem ()
    {
        return $this->hasMany(SupplyOrderItem::class, 'supply_order_id');
    }
}
