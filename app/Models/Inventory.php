<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable=[
        'item_id',
        'quantity',
        'last_update'
        
    ];
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
