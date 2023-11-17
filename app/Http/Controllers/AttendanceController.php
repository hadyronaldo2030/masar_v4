<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;


class AttendanceController extends Controller
{

    public function index()
    {
        //
    }

    // =========================== {  Create Attedancen } ===========================

    public function create(User $user)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {
            // Get All Employees
            $employees = $user->all();

             // Ruls Conditions 
        $userRole = auth()->user()->role;
        $userDepartment = auth()->user()->department;

        // If Status Admin
        if($userRole == 'admin'){
            $employees = $user->whereNotIn('role', ['admin'])->get();
        }elseif($userRole == 'hr'){
            $employees = $user->whereNotIn('role', ['admin'])->get();
        }else{
            $employees = $user->whereNotIn('role', ['admin','hr'])->get();

        }
            // Open Page DataEntry
            return view('admin.hr.dataEntry', compact('employees'));
        }else{
            return redirect('errors.403');
        }
    }


    public function store(Request $request)
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

            $employeeId = $request->input('employee_id');
            $employee = User::find($employeeId);

            // Condition Require Day
            $existingAttendance = Attendance::where('day', $request->input('day'))
                ->where('employee_id', $employeeId)
                ->first();

            if ($existingAttendance) {
                return redirect()->route('admin.hr.dataEntry')->with('errorDay', 'تم تسجيل حضور لهذا الموظف في نفس اليوم مسبقًا.');
            }

            // Conditions
            if (($request->absent && $request->check_in) || ($request->absent && $request->check_out)) {
                return redirect()->route('admin.hr.dataEntry')->with('errorOnLeave', 'لا يمكن تحديد الغياب و وقت الحضور والانصراف معا');
            }

            if (($request->on_leave && $request->check_in) || ($request->on_leave && $request->check_out)) {
                return redirect()->route('admin.hr.dataEntry')->with('errorOnLeave', 'لا يمكن تحديد الاجازه و وقت الحضور والانصراف معا');
            }

            if ($request->absent && $request->on_leave) {
                return redirect()->route('admin.hr.dataEntry')->with('errorOnLeave', 'لا يمكن تحديد الغياب والإجازة معًا.');
            }

            if ($request->check_in && !$request->check_out) {
                return redirect()->route('admin.hr.dataEntry')->with('errorCheckTime', 'يجب تحديد وقت الانصراف إذا تم تحديد وقت الحضور.');
            } elseif (!$request->check_in && $request->check_out) {
                return redirect()->route('admin.hr.dataEntry')->with('errorCheckTime', 'يجب تحديد وقت الحضور إذا تم تحديد وقت الانصراف.');
            }


            // تحقق من وجود بيانات في أحد الحقول عدا اليوم
            if (
                !$request->filled('check_in') &&
                !$request->filled('check_out') &&
                !$request->has('absent') &&
                !$request->has('on_leave') &&
                !$request->filled('notes') &&
                !$request->filled('rating')
            ) {
                return redirect()->route('admin.hr.dataEntry')->with('errorCheckTime', 'scadasdasdsad.');
            }


            try {

                // ========= {Create Data After Validate } =========

                $attendanceData = [
                    'employee_id' => $request->employee_id,
                    'day' => $request->input('day'),
                    'check_in' => $request->input('check_in'),
                    'check_out' => $request->input('check_out'),
                    'absent' => $request->has('absent'),
                    'on_leave' => $request->has('on_leave'),
                    'notes' => $request->input('notes'),
                    'rating' => $request->input('rating'),
                    'creator_name' => auth()->user()->name,
                ];
                // Save Data
                Attendance::create($attendanceData);

                // Test
                // dd($attendanceData);

            } catch (QueryException $e) {
                return redirect()->route('admin.hr.dataEntry')->with('error', ' يجب ادخال التاريخ اليوم ');
            };
            // Open Page  DataEntry Attendance
            return redirect()->route('admin.hr.dataEntry')->with('success', 'تم  تسجيل البيانات بنجاح ');
        }else{
            return redirect('errors.403');
        }
    }

    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        // dd($attendance->deductionsAndBonuses);
        return view('admin.hr.editEmp', compact('attendance'));
    }


    public function destroy(Request $request, $id)
    {
        // Authorize
        $this->authorize('isAdmin', 'isHr');
       
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return redirect()->back()->with('success', 'تم حذف بيانات الحضور بنجاح.');
    }
}

