<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        'table_id',
        'order_date',
        'status'
    ];
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    public function orderInteraction()
    {
        return $this->hasMany(OrderInteraction::class, 'order_id');
    }
}
