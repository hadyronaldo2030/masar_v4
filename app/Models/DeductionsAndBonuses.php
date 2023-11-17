<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class DeductionsAndBonuses extends Model
{
    use HasFactory,SoftDeletes;
    // Selected Name Table
    protected $table = 'deductions_and_bonuses';
    // Selected Data To pass in Table
   protected $guarded = [];

    // Relations To Employee
    public function employee(){
        return $this->belongsTo(User::class, 'employee_id');
    }

    // Relations To Attendance
    public function attendances()
    {
        return $this->belongsTo(Attendance::class, 'attendance_day_id');
    }

}
