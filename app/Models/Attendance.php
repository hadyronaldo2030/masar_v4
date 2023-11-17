<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import Models Employee
use App\Models\Employee;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory,SoftDeletes;
    // Selected Name Table
    protected $table = 'attendances';
    // Selected Data To pass in Table
     protected $fillable = [
        'day',
        'check_in',
        'check_out',
        'absent',
        'on_leave',
        'notes',
        'rating',
        'employee_id',
        'month',
        'creator_name',

        ];











    // Relations To Employee
    public function employee(){
        // belongsTo => "تعود القيم الي "
        return $this->belongsTo(User::class,'employee_id','id');
        // return $this->belongsTo(Employee::class);
    }

    public function deductionsAndBonuses()
    {
        return $this->hasMany(DeductionsAndBonuses::class, 'attendance_day_id');
    }
    
}