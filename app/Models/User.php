<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

use  App\Models\DeductionsAndBonuses;
use  App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory,Notifiable,SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'age',
        'mobile',
        'salary',
        'address',
        'jobTitle',
        'gender',
        'department',
        'status',
        'image',
        'image2',
        'image3',
        'month',
        'role',
        'creator_name',

    ];

    
    // Relations To Attendance
    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance','employee_id','id');
    }

     // Relations To Deductions And Bonuses
     public function deductionsAndBonuses()
     {
         return $this->hasMany(DeductionsAndBonuses::class, 'employee_id');
     }

    //  public function team()
    //  {
    //      return $this->hasMany(User::class, 'team_id');
    //  }

    public static function getImagesByTeamArray($teamArray)
    {
        // Use the $teamArray to retrieve the corresponding images
        // For simplicity, assuming that each team member has an 'image' attribute
        return User::whereIn('id', $teamArray)->pluck('image')->toArray();
    }

    
    public function getEmployeeCountByDepartment($department)
    {
        return $this->where('department', $department)->count();
    }
    //  public function user()
    //  {
    //      return $this->belongsTo(User::class);
    //  }
    // =================== { Method Helper } ===================

    // Update Notes In Table attendances


    // وظيفة لحساب عدد أيام الحضور خلال الشهر
    public function calculateAttendanceDays()
    {
        // حسال واسترجع عدد أيام الحضور من قاعدة البيانات لهذا الموظف في الشهر والسنة المحددين.
        return Attendance::where('employee_id', $this->id)
            ->whereMonth('day', now()->format('m'))
            ->whereNotNull('check_in')
            ->count();
    }


    public function calculateAbsenceDays($month)
    {
        // حساب واسترجاع عدد أيام الغياب من قاعدة البيانات لهذا الموظف في الشهر والسنة المحددين.
        return Attendance::where('employee_id', $this->id)
            ->whereMonth('day', $month)
            ->where('absent', true) // تحديد الحضور كـ absent
            ->count();
    }


    public function calculateAbsenceHoldayDays($month)
    {
        // حساب واسترجاع عدد أيام الغياب من قاعدة البيانات لهذا الموظف في الشهر والسنة المحددين.
        return Attendance::where('employee_id', $this->id)
            ->whereMonth('day', $month)
            ->where('on_leave', true) // تحديد الحضور كـ absent
            ->count();
    }



    public function calculateWorkingHoursInMonth($month, $year)
    {
        $totalWorkingHours = 0;

        // استعراض جميع الحضور والانصراف للموظف خلال الشهر المحدد
        foreach ($this->attendances as $attendance) {
            $attendanceDate = Carbon::parse($attendance->day);

            if ($attendanceDate->month == $month && $attendanceDate->year == $year) {
                $checkInTime = Carbon::parse($attendance->check_in);
                $checkOutTime = Carbon::parse($attendance->check_out);
                $workingHours = $checkOutTime->diffInHours($checkInTime);
                $totalWorkingHours += $workingHours;
            }
        }

        return $totalWorkingHours;
    }

    // Method Count Employee
    public static function getEmployeeCount()
    {
        return self::count();
    }

    // Method know Count Employee in month
    public static function getEmployeesAddedInMonth($year, $month)
    {
        return self::whereRaw('YEAR(created_at) = ?', [$year])
            ->whereRaw('MONTH(created_at) = ?', [$month])
            ->count();
    }

    // Method to get the count of employees
    public static function employeeCount()
    {
        return self::count();
    }


    // Method Account Work Hours
    public function calculateWorkHours($date)
    {
        $startOfDay = (new \DateTime($date))->setTime(0, 0, 0);
        $endOfDay = (new \DateTime($date))->setTime(23, 59, 59);

        $totalWorkHours = $startOfDay->diff($endOfDay);

        return $totalWorkHours->format('%H:%I');
    }


    // Method Calc absent for Month
    public function calculateAbsenceDaysInCurrentMonth()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $firstDayOfMonth = now()->startOfMonth();
        $lastDayOfMonth = now()->endOfMonth();

        $absenceDays = Attendance::where('employee_id', $this->id)
            ->whereBetween('day', [$firstDayOfMonth, $lastDayOfMonth])
            ->where('absent', true)
            ->count();

        return $absenceDays;
    }

    // Method Calc absent for Year
    public function calculateAbsenceDaysInCurrentYear()
    {
        $currentYear = now()->year;

        $firstDayOfYear = now()->startOfYear();
        $lastDayOfYear = now()->endOfYear();

        $absenceDays = Attendance::where('employee_id', $this->id)
            ->whereBetween('day', [$firstDayOfYear, $lastDayOfYear])
            ->where('absent', true)
            ->count();

        return $absenceDays;
    }




    // Method Calc on Leave for Month
    public function calculateOnLeaveDaysInCurrentMonth()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $absenceDays = Attendance::where('employee_id', $this->id)
            ->whereYear('day', $currentYear)
            ->whereMonth('day', $currentMonth)
            ->where('on_leave', true)
            ->count();

        return $absenceDays;
    }

    // Method Calc on Leave for Year
    public function calculateOnLeaveDaysInCurrentYear()
    {
        $currentYear = now()->year;

        $absenceDays = Attendance::where('employee_id', $this->id)
            ->whereYear('day', $currentYear)
            ->where('on_leave', true)
            ->count();

        return $absenceDays;
    }

    // Method Calc Work Hours for Today
    public function calculateWorkHoursForToday()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;
        $currentDay = now()->day;
    
        $workHours = 0;
    
        $attendances = Attendance::where('employee_id', $this->id)
            ->whereYear('day', $currentYear)
            ->whereMonth('day', $currentMonth)
            ->whereDay('day', $currentDay)
            ->whereNotNull('check_in')
            ->whereNotNull('check_out')
            ->get();
    
        foreach ($attendances as $attendance) {
            $checkIn = strtotime($attendance->check_in);
            $checkOut = strtotime($attendance->check_out);
    
            if ($checkIn && $checkOut && $checkOut > $checkIn) {
                $workHours +=  ($checkOut - $checkIn); // استخدم += لإضافة الساعات
            }
        }
    
        $workHoursInteger = intval($workHours / 3600); // قم بتحويل الوقت إلى عدد الساعات
    
        return $workHoursInteger;
    }
    


    // Method Calc Work Hours for Month
    public function calculateWorkHoursInCurrentMonth()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $workHours = 0;

        $attendances = Attendance::where('employee_id', $this->id)
            ->whereYear('day', $currentYear)
            ->whereMonth('day', $currentMonth)
            ->whereNotNull('check_in')
            ->whereNotNull('check_out')
            ->get();

        foreach ($attendances as $attendance) {
            $checkIn = strtotime($attendance->check_in);
            $checkOut = strtotime($attendance->check_out);

            if ($checkIn && $checkOut && $checkOut > $checkIn) {
                $workHours += ($checkOut - $checkIn) / 3600;
            }
        }
        $workHoursInteger = intval($workHours);

        return $workHoursInteger;
    }


    // Method Calc Work Hours for Year
    public function calculateWorkHoursInCurrentYear()
    {
        $currentYear = now()->year;

        $workHours = 0;

        $attendances = Attendance::where('employee_id', $this->id)
            ->whereYear('day', $currentYear)
            ->whereNotNull('check_in')
            ->whereNotNull('check_out')
            ->get();

        foreach ($attendances as $attendance) {
            $checkIn = strtotime($attendance->check_in);
            $checkOut = strtotime($attendance->check_out);

            if ($checkIn && $checkOut && $checkOut > $checkIn) {
                $workHours += ($checkOut - $checkIn) / 3600;
            }
        }

        $workHoursInteger = intval($workHours);

        return $workHoursInteger;
    }




    // Method Calc Attendance for Month

    public function calculateAttendanceDaysInCurrentMonth()
    {
        $currentYear = now()->year;
        $currentMonth = now()->month;

        $attendanceDays = Attendance::where('employee_id', $this->id)
            ->whereYear('day', $currentYear)
            ->whereMonth('day', $currentMonth)
            ->whereNotNull('check_in')
            ->count();

        return $attendanceDays;
    }



    public function calculateAttendanceDaysInCurrentYear()

    {
        $currentYear = now()->year;

        $attendanceDays = Attendance::where('employee_id', $this->id)
            ->whereYear('day', $currentYear)
            ->whereNotNull('check_in')
            ->count();

        return $attendanceDays;
    }

}

