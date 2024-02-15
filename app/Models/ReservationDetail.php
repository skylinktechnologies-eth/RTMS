<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDetail extends Model
{
    use HasFactory;
    protected $fillable=[
        'table_id',
         'reservation_id',
         'reservation_time',
         'occupancy_start_date',
         'occupancy_end_date'
    ];
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
}

