<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $fillable=[
        'location_name'
    ];
    public function issuing()
    {
        return $this->hasMany(Issuing::class,'location_id');
    }
}
