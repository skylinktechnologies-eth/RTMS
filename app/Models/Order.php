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
}
