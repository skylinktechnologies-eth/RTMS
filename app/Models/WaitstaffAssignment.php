<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitstaffAssignment extends Model
{
    use HasFactory;
    protected $fillable = [
        'table_id',
        'waitstaff_id',
        'assignment_date'

    ];
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
    public function waitstaff()
    {
        return $this->belongsTo(Waitstaff::class, 'waitstaff_id');
    }
}
