<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otherstaff extends Model
{
    use HasFactory;
    protected $fillable= [
        'first_name',
        'last_name',
        'contact_number',
        'hire_date',
        'status'
    ];
}
