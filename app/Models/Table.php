<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    protected $fillable = [
        'table_name',
        'capacity',
        'status'
    ];

    public function reservationDetail()
    {
        return $this->hasMany(ReservationDetail::class, 'table_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'table_id');
    }
    public function waitstaffAssignment()
    {
        return $this->hasMany(WaitstaffAssignment::class, 'table_id');
    }
}
