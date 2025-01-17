<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderInteraction extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'waitstaff_id',
        'interaction_type',
        'interaction_date'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
