<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTaskManager;
use App\Models\Project;
use App\Models\ProjectMarketing;
use App\Models\ProjectProgramming;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class MangerController extends Controller
{

    // =========================== { Start Page Show All Employees  } ===========================
    public function index(User $user)
        {
            if (auth()->user()->can('isAdmin') || auth()->user()->can('isManager') ) {

            // Ruls Conditions
            $userRole = auth()->user()->role;
            $userDepartment = auth()->user()->department;


            // If Status Admin project


            if ($userRole == 'admin'  ) {
                $employees = $user->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->get();

                // Count Project Marketing  Complate
                $projectComplatet = ProjectMarketing::where('completion_percentage','=','100%')->where('department', "!=", ['programming'])->get();
                $projectComplatet2 = ProjectProgramming::where('completion_percentage','=','100%')->get();
                // Count Project Marketing Not Complate
                $countProjectNotComploate = ProjectMarketing::where('completion_percentage','!=','100%')->count()
                + ProjectProgramming::where('completion_percentage','!=','100%')->count();
                $countProjectNotComploate2 = ProjectMarketing::where('completion_percentage','!=','100%')->count() ;
                $countProjectNotComploate3 = ProjectProgramming::where('completion_percentage','!=','100%')->count() ;
            }
            elseif ($userRole == 'manager' && $userDepartment == 'programming') {
                        $employees = $user->where('department', ['programming'])->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->get();

                            // Count Project Marketing  Complate
                            $projectComplatet = ProjectProgramming::where('completion_percentage','=','100%')->get() ;

                            // Count Project Marketing Not Complate
                            $countProjectNotComploate = ProjectProgramming::where('completion_percentage','!=','100%')->count();
                            $countProjectNotComploate2 = ProjectProgramming::where('completion_percentage','!=','100%')->count() ;
                            $countProjectNotComploate3 = ProjectProgramming::where('completion_percentage','!=','100%')->count() ;


            return view('manger.marketing.dashbordMarketting', compact('employees','projectComplatet','countProjectNotComploate','countProjectNotComploate2','countProjectNotComploate3'));

            }
            elseif ($userRole == 'manager' && $userDepartment != 'programming') {
                $employees = $user->where('department', "!=", ['programming'])->whereNotIn('role', ['admin', 'hr', 'finance', 'manager', 'dataentry'])->get();

                // Count Project Marketing  Complate
                $projectComplatet = ProjectMarketing::where('completion_percentage','=','100%')->where('department', "!=", ['programming'])->get() ;

                // Count Project Marketing Not Complate
                $countProjectNotComploate = ProjectMarketing::where('completion_percentage','!=','100%')->where('department', "!=", ['programming'])->count();
                $countProjectNotComploate2 = ProjectMarketing::where('completion_percentage','!=','100%')->count() ;
                $countProjectNotComploate3 = ProjectMarketing::where('completion_percentage','!=','100%')->count() ;

                return view('manger.marketing.dashbordMarketting', compact('employees','projectComplatet','countProjectNotComploate','countProjectNotComploate2','countProjectNotComploate3'));
            }
            // return $projectComplatet;
            // return $employees;
            return view('manger.marketing.dashbordMarketting', compact('employees','projectComplatet','projectComplatet2','countProjectNotComploate','countProjectNotComploate2','countProjectNotComploate3'));
        }
        // dd(auth()->user());
            abort(403, 'Unauthorized');
}
    // =========================== { End Show All Employees  } ===========================

    // =========================== { Start Page Show Create Marketing Tasks  } ===========================
    public function create()
        {

            if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department != 'programming')) {

            // Ruls Conditions
            $userRole = auth()->user()->role;
            $userDepartment = auth()->user()->department;


            return view('manger.marketing.taskCreateMar');

        }
        abort(403, 'Unauthorized');

}
    // =========================== { End Page Show Create Marketing Tasks  } ===========================

    // =========================== { Start Page Show Create programmer Tasks  } ===========================
    public function createPro()
        {
            if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department == 'programming')) {

            // Ruls Conditions
            $userRole = auth()->user()->role;
            $userDepartment = auth()->user()->department;


            return view('manger.programming.taskCreatePro');

        }
        abort(403, 'Unauthorized');

}
    // =========================== { End Page Show Create programmer Tasks  } ===========================

    // =========================== {  Start Save Tasks  } ===========================
    public function storeMarketing(Request $request)
        {
            if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department != 'programming')) {

            try {
                $request->validate([
                    // 'file_marketing' => 'required|max:10000|mimetypes:image/jpeg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                    'file_marketing' => 'nullable',
                ]);

                $project = new ProjectMarketing;
                $project->project_name = $request->input('project_name');
                $project->start_date = $request->input('start_date');
                $project->end_date = $request->input('end_date');
                $project->department = $request->input('department');
                $project->tmLeader = $request->input('tmLeader');
                $project->team = json_encode($request->input('team'));
                $project->creator_name = auth()->user()->name;
                $project->notesmar = $request->input('notesmar');



            // If Condition Image Or Pdf And Saveing
            if ($request->hasFile('file_marketing')) {
                $file = $request->file('file_marketing');
                $fileExtension = $file->getClientOriginalExtension();

                // if (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                //     // If Condition File Pdf
                //     // $pdfName = uniqid('pdf_', true) . '.' . $request->file_marketing->extension();

                //     $pdfName = time() . '-' . $project->project_name . '-' . 'Marketing' . '.' . $request->file_marketing->extension();
                //     $request->file_marketing->move(public_path('images/manager/marketing/images'), $pdfName);
                //     // $path = 'images/manager/marketing/pdf' . $pdfName;
                //     $path = $pdfName;
                // } else {
                    // If Condition File Image
                    // $imageName = uniqid('image_', true) . '.' . $request->file_marketing->extension();

                    $imageName = time() . '-' . $project->project_name . '-'  . '.' . $request->file_marketing->extension();
                    $request->file_marketing->move(public_path('images/manager/marketing/images'), $imageName);
                    // $path = 'images/manager/marketing/images' . $imageName;
                    $path =  $imageName;
                // }
                // Save Value In Variable
                $project->file_marketing = $path;


                // Test Before Save
                // dd($request->all());

            }
            // Save All Data
            // dd($request->all())   ;
            $project->save();

            } catch (Exception $e) {
                // ========= {Message Error And  Redirect Path } =========
                // Test Error
                //    return 'Error ';
                // dd($e->getMessage()) ;
                return redirect()->back()
                    ->with('erorr', "Can't Create Project Becouse Find Error ");
            };



            return redirect()->back()->with('success', 'تم حفظ المشروع بنجاح.');
        }
        abort(403, 'Unauthorized');

}
    // =========================== {  End Save Tasks  } ===========================


    // =========================== {  Start Update Tasks  } ===========================
        public function updateMar(Request $request, $projectId)
            {
                if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department != 'programming')) {

                try {
                    $request->validate([
                        'file_marketing' => 'nullable',
                    ]);

                    // Find the existing project
                    $project = ProjectMarketing::findOrFail($projectId);

                    // Update the project attributes
                    $project->project_name = $request->input('project_name');
                    $project->start_date = $request->input('start_date');
                    $project->end_date = $request->input('end_date');
                    $project->department = $request->input('department');
                    $project->tmLeader = $request->input('tmLeader');
                    $project->team = json_encode($request->input('team'));
                    $project->creator_name = auth()->user()->name;
                    $project->notesmar = $request->input('notesmar');

                    // If Condition Image Or Pdf And Saving
                    if ($request->hasFile('file_marketing')) {
                        $file = $request->file('file_marketing');
                        $fileExtension = $file->getClientOriginalExtension();

                        if ($fileExtension == 'pdf') {
                            $pdfName = time() . '-' . $project->project_name . '-' . 'Marketing' . '.' . $fileExtension;
                            $file->move(public_path('images/manager/marketing/images'), $pdfName);
                            $path = $pdfName;
                        } else {
                            $imageName = time() . '-' . $project->project_name . '-' . 'Marketing' . '.' . $fileExtension;
                            $file->move(public_path('images/manager/marketing/images'), $imageName);
                            $path =  $imageName;
                        }

                        // Save Value In Variable
                        $project->file_marketing = $path;
                    }
                    // dd($project->all());
                    // Save Updated Data
                    $project->save();
                } catch (Exception $e) {
                    // Handle the exception as needed\
                    dd($e->getMessage());

                    return redirect()->back()
                        ->with('error', "Can't update project due to an error.");
                }
                return redirect()->back()->with('success', 'تم تحديث المشروع بنجاح.');
            }
            abort(403, 'Unauthorized');
    }
    // =========================== { End Update Tasks  } ===========================


    // =========================== { Start edit Tasks  } ===========================
    public function editMarketing(Request $request,$projectId)
        {
            if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department != 'programming')) {

            try {
                // Find the existing project
                $project = ProjectMarketing::findOrFail($projectId);
                return view('manger.marketing.editTaskMar', compact('project'));

                }catch (Exception $e) {
                    abort(404);
                }
        }
        abort(403, 'Unauthorized');

}
    // =========================== {  End Tasks  } ===========================


    // =========================== { Start Show Project Marketing } ===========================
    public function showProjectMarketing(ProjectMarketing $projectMarketing ){
            if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department != 'programming') || (auth()->user()->can('isEmployee') && auth()->user()->department != 'programming')) {

                // $proMarket = $projectMarketing->get();
                // return $proMarket ;
                // return view('manger.marketing.projectmarketing' ,compact('proMarket'));
                $proMarket = $projectMarketing->get();

                $teamMembersData = [];

                foreach ($proMarket as $Market) {
                    $teamMembers = [];

                    foreach (json_decode($Market->team) as $teamMemberId) {
                        $teamMembers[] = [
                            "id" => $teamMemberId,
                            "name" =>User::find($teamMemberId)->name,
                            "image" => User::find($teamMemberId)->image,
                        ];
                    }

                    $teamleader = $Market->tmLeader;

                    $teamMembersData[] = [
                        "id" => $Market->id,
                        "project_name" => $Market->project_name,
                        "start_date" => $Market->start_date,
                        "end_date" => $Market->end_date,
                        "department" => $Market->department,
                        "project_manager" => null,
                        "tmLeaderName" => User::find($teamleader)->name,
                        "tmLeaderImage" => User::find($teamleader)->image,
                        "team" => $teamMembers,
                        "notesmar" => $Market->notesmar,
                        "file_marketing" => $Market->file_marketing,
                        "completion_percentage" => $Market->completion_percentage,
                    ];
                    }

                // return $teamMembersData;
                return view('manger.marketing.projectmarketing', compact('teamMembersData'));
            }
            abort(403, 'Unauthorized');
    }
    // =========================== { End Show Project Marketing } ===========================

    // =========================== { Start Update completion percentage  Project Marketing } ===========================
    public function updateMarketing(Request $request, $projectId)
    {
        if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department != 'programming')) {

           try {
            $project = ProjectMarketing::findOrFail($projectId);
            $project->completion_percentage = $request->input('completion_percentage');
            $project->save();

            return response()->json(['success' => true, 'message' => 'تم تحديث القيمة بنجاح']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء تحديث القيمة']);
        }
        abort(403, 'Unauthorized');
        }
    }
    // =========================== { End Update completion percentage  Project Marketing } ===========================



      // ========================={{ Start Delete Marketing }}===================================

      public function destroy($id)
      {

          // Find the existing contract by ID
          $contract = ProjectMarketing::findOrFail($id);
          // Delete the contract
          $contract->delete();


          // Redirect or return a response indicating successful deletion
          return redirect()->back()
              ->with('success', 'تم حذف المهمة بنجاح');

    }
      // ========================={{ End Delete }}===================================

}
