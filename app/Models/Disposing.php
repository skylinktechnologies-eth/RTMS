<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposing extends Model
{
    use HasFactory;
    protected $fillable=[
        'disposed_by',
        'disposed_date',
        'reason'
    ];
    public function disposingItem ()
    {
        return $this->hasMany(DisposingItem::class, 'disposing_id');
    }
}
