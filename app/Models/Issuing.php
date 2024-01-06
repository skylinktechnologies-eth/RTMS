<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issuing extends Model
{
    use HasFactory;
    protected $fillable=[
        'location_id',
        'issued_date',
        'issued_to'
    ];
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function issuingItem ()
    {
        return $this->hasMany(IssuingItem::class, 'issuing_id');
    }
}
