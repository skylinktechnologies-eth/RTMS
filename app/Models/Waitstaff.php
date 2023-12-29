<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waitstaff extends Model
{
    use HasFactory;
    protected $fillable= [
        'first_name',
        'last_name',
        'contact_number',
        'hire_date',
        'status'
    ];
    public function waitstaffAssignment()
    {
        return $this->hasMany(WaitstaffAssignment::class, 'waitstaff_id');
    }
}
