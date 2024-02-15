<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        
        'reservation_date',
        'party_size',
        'contact_name',
        'contact_number',
        'status'
    ];
    public function reservationDetail()
    {
        return $this->hasMany(ReservationDetail::class, 'reservation_id');
    }
}
