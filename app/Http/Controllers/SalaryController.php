<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DeductionsAndBonuses;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->can('isAdmin') || auth()->user()->can('isFinance')) {
                return $next($request);
            }

            abort(403, 'Unauthorized');
        });
    }

    public function index(Request $request, User $user)
    {

        // Model Employees
        $employees = User::all();
          // Ruls Conditions 
          $userRole = auth()->user()->role;
          // If Status Admin
          if($userRole == 'admin'){$employees = $user->whereNotIn('role', ['admin'])->get();}
          // If Status Admin
          if($userRole == 'finance'){ $employees = $user->whereNotIn('role', ['admin'])->get();}

        $employeesTotal = [
            // Total Salary
            'totalSalaries' => $employees->sum('salary'),
            // Total Employee
            'totalEmployee' => $employees->count(),
        ];

        // Model DeductionsAndBounses
        $deductionsAndBonuses = new DeductionsAndBonuses();
        // dd($deductionsAndBonuses); 


        $deductionsAndBonusesTotal = [
            // Total Discount
            'totalDiscount' => $deductionsAndBonuses->where('status', 'discount')->sum('price'),
            // Total Bonus
            'totalBonus' => $deductionsAndBonuses->where('status', 'bonus')->sum('price'),
            // Total Advance
            'totalAdvance' => $deductionsAndBonuses->where('status', 'advance')->sum('price'),
        ];






        // Array Variable Month Name 
        $months = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December',
        ];

        // Get Query Filter ?month= num_month

        // $month = $request->query()["month"] ?? 10;
        $month = $request->query("month");

        $additionalFilters = [];
        if ($month) {
            $additionalFilters[] = ['day', 'month', $month];
        }

        $employess = [];

        $salary = $user->select('department')
            ->selectRaw('month(attendances.day) as dayMonth')
            ->join('attendances', 'users.id', '=', 'attendances.employee_id')
            ->where($additionalFilters)
            ->groupBy('dayMonth', 'department')
            ->distinct()
            ->get();

        $departmentCounts = [];

        foreach ($salary as $row) {
            $emps = $user->where("department", $row->department)


                ->with([
                    "deductionsAndBonuses" => function ($q) use ($row) {
                        $q->with([
                            "attendances" => function ($q2) use ($row) {
                                $q2->select("id", "day")->whereMonth("day", $row->dayMonth);
                            }

                        ]);
                    }

                ])->get()->toArray();



            foreach ($emps as &$e) {
                $deductionsAndBonuses = [
                    "discount" => 0,
                    "advance" => 0,
                    "bonus" => 0,

                ];
                foreach ($e["deductions_and_bonuses"]  as $des) {
                    $deductionsAndBonuses[$des["status"]] += intval($des["price"]);
                }


                $e["deductions"] = $deductionsAndBonuses;
            }


            $departmentCounts[$row->department . "-" . $row->dayMonth] = $user->getEmployeeCountByDepartment($row->department);

            $employess[$row->department . "-" . $row->dayMonth] = $emps;
        }

        // return  $employess;


        return view('admin.fiances.bonusesdiscounts', compact('salary', "months", "employess", 'deductionsAndBonusesTotal', 'employeesTotal','departmentCounts'));
    }
}
