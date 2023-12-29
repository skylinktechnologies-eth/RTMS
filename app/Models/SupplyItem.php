<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'item_name',
        'category',
        'unit_of_measure',
        'price'
    ];
}
