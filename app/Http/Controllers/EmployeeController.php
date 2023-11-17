<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployees;
use App\Models\DeductionsAndBonuses;
use App\Models\User;
use Attribute;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// Import File Traits

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Auth\Access\Gate;
class EmployeeController extends Controller
{

    // use Customer Traits




    // Method
    // استدعاء الدالة لحساب عدد ساعات العمل للموظف


    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr')) {
        //         return $next($request);
        //     }

        //     abort(403, 'Unauthorized');
        // });
    }
    // =========================== { Page Show All Employees  } ===========================

    public function index()
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry') ) {
            // dd(auth()->user()->can('isDataEntry'));

        // Authorize
        // $this->authorize('isAdmin','isHr');

        //Get Data Employees
        // $employees = Employee::all();

         // Ruls Conditions 
         $userRole = auth()->user()->role;
         $userDepartment = auth()->user()->department;
 
         // If Status Admin
         if($userRole == 'admin'){
            $employees = User::orderBy('created_at', 'asc')->whereNotIn('role', ['admin'])->get();
 
         }elseif($userRole == 'hr'){
            $employees = User::orderBy('created_at', 'asc')->whereNotIn('role', ['admin'])->get();

         }elseif($userRole == 'dataentry'){
            $employees = User::orderBy('created_at', 'asc')->whereNotIn('role', ['hr','admin'])->get();
         }

        //  $employees = User::orderBy('created_at', 'asc')->whereNotIn('role', ['hr', 'finance','manager','dataentry'])->get();

        return view('admin.hr.empList', compact('employees'));
        // return view('admin.hr.empList',Employee::orderBy('created_at','asc')->get(),compact('employees'));
        }else{
            abort(403, 'Unauthorized');

        }
    }

    // =========================== { Page Create Employee  } ===========================
    public function create()
    {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {

        // Open Page Create Employees
        return view('admin.hr.addEmp');
        }else{
            abort(403, 'Unauthorized');

        }
    }
    
    public function createAdmin()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->can('isAdmin')) {
                return $next($request);
            }

            abort(403, 'Unauthorized');
        });
        return view('auth.register');

    }

    // =========================== {  Create Admin And Save  } ===========================
    public function storeAdmin(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->can('isAdmin') ) {
                return $next($request);
            }

            abort(403, 'Unauthorized');
        });

        // Test
        // dd($request->all());
        try {
            // ========= {Method Image upload} =========
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $imageName2 = null;
            if ($request->hasFile('image2')) {
                $imageName2 = time() . '2.' . $request->image2->extension();
                $request->image2->move(public_path('images'), $imageName2);
            }

            $imageName3 = null;
            if ($request->hasFile('image3')) {
                $imageName3 = time() . '3.' . $request->image3->extension();
                $request->image3->move(public_path('images'), $imageName3);
            }

            // Save Table User Email And Password
            User::create([
                    'id' => $request->id,
                    'name' => $request->name,
                    'age' => $request->age,
                    'salary' => $request->salary,
                    'address' => $request->address,
                    'jobTitle' => $request->jobTitle,
                    'mobile' => $request->mobile,
                    'gender' => $request->gender,
                    'department' => $request->department,
                    'status' => $request->status,
                    'image' => $imageName,
                    'image2' => $imageName2 ?? '',
                    'image3' => $imageName3 ?? '',        
                    'email' => $request->email,
                    'password' =>  Hash::make($request->password),
                    'role' => $request->role,
                ]);

        } catch (Exception $e) {
            // ========= {Message Error And  Redirect Path } =========
            // Test Error
            //    return 'Error ';
            return redirect()->back()
                ->with('erorr', "Can't Create Empployees Becouse Find Error ");
        };


        // ========= {Message Success And  Redirect Path } =========
        return redirect('/client/login')
            ->with('success', 'Create A New Employee Successfully');
    }


    // =========================== {  Create Employee And Save  } ===========================
    public function store(CreateEmployees $request)
    {

        // Authorize
    //    $this->authorize('isAdmin','isHr');
    if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {


        // Test
        // dd($request->all());
        try {
            // ========= {Method Image upload} =========
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $imageName2 = null;
            if ($request->hasFile('image2')) {
                $imageName2 = time() . '2.' . $request->image2->extension();
                $request->image2->move(public_path('images'), $imageName2);
            }

            $imageName3 = null;
            if ($request->hasFile('image3')) {
                $imageName3 = time() . '3.' . $request->image3->extension();
                $request->image3->move(public_path('images'), $imageName3);
            }

            // Save Table User Email And Password
            User::create([
                    'id' => $request->id,
                    'name' => $request->name,
                    'age' => $request->age,
                    'salary' => $request->salary,
                    'address' => $request->address,
                    'jobTitle' => $request->jobTitle,
                    'mobile' => $request->mobile,
                    'gender' => $request->gender,
                    'department' => $request->department,
                    'status' => $request->status,
                    'image' => $imageName,
                    'image2' => $imageName2 ?? '',
                    'image3' => $imageName3 ?? '',        
                    'email' => $request->email,
                    'password' =>  Hash::make($request->password),
                    'role' => $request->role,
                    'creator_name' => auth()->user()->name,
                ]);

        } catch (Exception $e) {
            // ========= {Message Error And  Redirect Path } =========
            // Test Error
            //    return 'Error ';
            return redirect()->back()
                ->with('erorr', "Can't Create Empployees Becouse Find Error ");
        };


        // ========= {Message Success And  Redirect Path } =========
        return redirect()->route('admin.hr.empList')
            ->with('success', 'Create A New Employee Successfully');
    }else{
            abort(403, 'Unauthorized');
    }
}

    // =========================== { Page Show Employee  } ===========================
    public function show(string $id, Request $request)
    {

        // if (Gate::allows('view-profile', $employee)) {
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {

            
        
        // Get Employee Id
        $employee = User::findOrFail($id);

         // Check if the user being viewed is an admin
        if ($employee->role == 'admin') {
            if(auth()->user()->can('isAdmin')){
                
            }else{

                // If it's an admin, show 404 page (Unauthorized)
                abort(403);
            }
        }
        // return $employee->role;
                    // Get the selected month from the request
            $selectedMonth = $request->input('month', now()->month);

            // Get the attendance records for the selected month
            $filteredData = $employee->attendances()->whereMonth('day', $selectedMonth)->get();

            // Show Id Employee page without edit
            return view('admin.hr.showEmp', compact('employee', 'filteredData'));
        
        }else{
            // Get Employee Id
            $employee = User::findOrFail($id)->where('id',Auth::user()->id)->first();
            if($employee === null){
                return redirect()->back();
            }

                    // Get the selected month from the request
            $selectedMonth = $request->input('month', now()->month);

            // Get the attendance records for the selected month
            $filteredData = $employee->attendances()->whereMonth('day', $selectedMonth)->get();

            // Show Id Employee page without edit
            return view('admin.hr.showEmp', compact('employee', 'filteredData'));

        }
        //     abort(403, 'Unauthorized');

    
      
    }


    // =========================== { Page Edit Employee  } ===========================


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id,Request $request)
    {
         // Authorize
         if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {

        try {
        $employee = User::findOrFail($id);


        // Get the selected month from the request
        $selectedMonth = $request->input('month', now()->month);

        // Get the attendance records for the selected month
        $filteredData = $employee->attendances()->whereMonth('day', $selectedMonth)->get();

            return view('admin.hr.editEmp', compact('employee','filteredData'));
        } catch (Exception $e) {
            return redirect()->route('admin.hr.empList',)
                ->with('error', 'حدث خطأ أثناء فتح صفحة تعديل الموظف.');
        }
        // Edit Employee page
        // dd($data );
        return view('admin.hr.editEmp', compact('employee', 'data',));
    }
            abort(403, 'Unauthorized');

}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

       // Authorize
       if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {
        try {
            // ========= {Validate Data} =========
            $request->validate([
                'name' => 'required|string|max:255',
                'mobile' => 'required|string|max:12',
                'address' => 'required|string|max:255',
                'jobTitle' => 'required|string|max:100',
                'salary' => 'required|numeric',
                'gender' => 'required',
                'age' => 'required',
                'department' => 'required',
                'status' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // ========= {Method Image upload} =========
            $imageName = null;
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
            }

            $imageName2 = null;
            if ($request->hasFile('image2')) {
                $imageName2 = time() . '2.' . $request->image2->extension();
                $request->image2->move(public_path('images'), $imageName2);
            }

            $imageName3 = null;
            if ($request->hasFile('image3')) {
                $imageName3 = time() . '3.' . $request->image3->extension();
                $request->image3->move(public_path('images'), $imageName3);
            }

            // ========= {Check Number Phone Don't Repeat} =========
            $mobile = $request->mobile;
            $employeeId = $id; // Assuming 'id' is sent in the request

            $existingEmployee = User::where('mobile', $mobile)
                ->where('id', '!=', $id) // Exclude the current employee
                ->first();

            if ($existingEmployee) {
                return redirect()->back()->withInput()->withErrors(['mobile' => 'رقم الهاتف مكرر.']);
            }

            // ========= {Find the Employee and Update Data} =========
            $employee = User::findOrFail($employeeId);
        
            // dd($employee);
            $employee->update([
                // 'id'=>$request->id,
                'name' => $request->name,
                'age' => $request->age,
                'address' => $request->address,
                'jobTitle' => $request->jobTitle,
                'salary' => $request->salary,
                'mobile' => $request->mobile,
                'gender' => $request->gender,
                'department' => $request->department,
                'status' => $request->status,
                'image' => $imageName ?? $employee->image,
                'image2' => $imageName2 ?? $employee->image2,
                'image3' => $imageName3 ?? $employee->image3,
                'email' => $request->email,
                'password' =>  Hash::make($request->password),
                'role' => $request->role,
            ]);

            // ========= {Message Success And Redirect Path} =========
            return redirect()->route('admin.hr.empList')
                ->with('Success', 'تم تحديث بيانات الموظف بنجاح.');
        } catch (Exception $e) {
            // ========= {Message Error And Redirect Path} =========
            // Test Error
            dd($e);

            return $e ;
            return redirect()->back()
                ->with('error', 'حدث خطأ أثناء تحديث بيانات الموظف.');
        }
    }else{
        abort(403, 'Unauthorized');
    }
}




    // =========================== {  Delete Employee } ===========================
    public function destroy(string $id)
    {
        // Authorize
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {


        // Delete Employee
        $employee = User::findOrFail($id);
        // Delete the images from the filesystem
        $imagePaths = [];
        if ($employee->image) {
            $imagePaths[] = public_path('images/' . $employee->image);
        }

        if ($employee->image2) {
            $imagePaths[] = public_path('images/' . $employee->image2);
        }

        if ($employee->image3) {
            $imagePaths[] = public_path('images/' . $employee->image3);
        }

        foreach ($imagePaths as $imagePath) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }


        // Delete Data Employee
        $employee->delete();
        return redirect()->route('admin.hr.empList')->with('success', 'تم حذف بيانات الموظف بنجاح.');
    }else{
        abort(403, 'Unauthorized');
    }
}


    // Method Additions

    // Deshboard Method Count Employee
    public function showEmployees()
    {
        // Authorize
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {


        $now = getdate();
        $employeeCount = User::getEmployeeCount();
        $newEmployeesThisMonth = User::getEmployeesAddedInMonth($now['year'], $now['mon']);

        return view('/admin/hr/dashboard', ['employeeCount' => $employeeCount, 'newEmployeesThisMonth' => $newEmployeesThisMonth]);
    }else{
        abort(403, 'Unauthorized');
    }
    }



//  ===================== {{ Update Notes  }} =====================
    public function updateNotes(Request $request, $id)
    {
        // Authorize
        // $this->authorize('isAdmin','isHr','isDataEntry');
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

        // Test Code
        // dd($request->all());

        // Get ID
        $attendance = Attendance::findOrFail($id);
        // Update
        $attendance->update($request->all());

        // Return
        return redirect()->back()->with('success', 'تم تحديث بيانات الحضور ب    نجاح.');
    }else{
        abort(403, 'Unauthorized');
    }
}


//  ===================== {{ Update Deductions And Bonuses  }} =====================

    public function updateDeductionsAndBonuses(Request $request, $id)
    {
       // Authorize
       if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') ) {
        // Test Code
        // dd($request->all());

        // Get ID
        $bounses = DeductionsAndBonuses::findOrFail($id);

        // Update
        $bounses->update($request->all());

        // Return
        return redirect()->back()->with('success', 'تم تحديث بيانات الخصومات والمكافأت ب    نجاح.');
    }else{
        abort(403, 'Unauthorized');
    }
    }   

}
