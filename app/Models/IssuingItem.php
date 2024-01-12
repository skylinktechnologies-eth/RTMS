<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuingItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'issuing_id',
        'item_id',
        'quantity'
    ];
    public function issuing()
    {
        return $this->belongsTo(Issuing::class, 'issuing_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
