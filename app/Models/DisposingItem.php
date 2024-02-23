<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposingItem extends Model
{
    use HasFactory;
    protected $fillable=[
        'disposing_id',
        'item_id',
        'quantity',
        'total'
    ];
    public function disposing()
    {
        return $this->belongsTo(Disposing::class, 'disposing_id');
    }
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }
}
