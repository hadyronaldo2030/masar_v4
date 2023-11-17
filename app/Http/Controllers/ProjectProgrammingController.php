<?php

namespace App\Http\Controllers;

use App\Models\ProjectMarketing;
use App\Models\ProjectProgramming;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class ProjectProgrammingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // =========================== { Authorizetion  } ===========================
    // public function __construct()
    // {
    //     $this->middleware(function ($request, $next) {
    //         if (auth()->user()->can('isAdmin') || auth()->user()->can('isManager')) {
    //             return $next($request);
    //         }

    //         abort(403, 'Unauthorized');
    //     });
    // }




    // =========================== {  Save Tasks  } ===========================
    public function storeProgramming(Request $request)
    {
        if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department == 'programming')) {

        try {
            $request->validate([
                'file_programming' => 'required|max:10000|mimetypes:image/jpeg,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                ]);

            $project = new ProjectProgramming;
            $project->project_name = $request->input('project_name');
            $project->start_date = $request->input('start_date');
            $project->end_date = $request->input('end_date');
            $project->department = $request->input('department');
            $project->tmLeader = $request->input('tmLeader');
            $project->team = json_encode($request->input('team'));
            $project->creator_name = auth()->user()->name;
            $project->notespro = $request->input('notespro');



        // If Condition Image Or Pdf And Saveing
        if ($request->hasFile('file_programming')) {
            $file = $request->file('file_programming');
            $fileExtension = $file->getClientOriginalExtension();

            if ($fileExtension == 'pdf') {
                // If Condition File Pdf
                // $pdfName = uniqid('pdf_', true) . '.' . $request->file_programming->extension();

                $pdfName = time() . '-' . $project->project_name . '-' . 'Marketing' . '.' . $request->file_programming->extension();
                $request->file_programming->move(public_path('images/manager/programming/pdf'), $pdfName);
                // $path = 'images/manager/programming/pdf' . $pdfName;
                $path = $pdfName;
            } else {
                // If Condition File Image
                // $imageName = uniqid('image_', true) . '.' . $request->file_programming->extension();

                $imageName = time() . '-' . $project->project_name . '-' . 'Marketing' . '.' . $request->file_programming->extension();
                $request->file_programming->move(public_path('images/manager/programming/images'), $imageName);
                // $path = 'images/manager/programming/images' . $imageName;
                $path =  $imageName;
            }
            // Save Value In Variable
            $project->file_programming = $path;


            // Test Before Save

        }
        // dd($request->all());
        // Save All Data
        $project->save();

        } catch (Exception $e) {
            // ========= {Message Error And  Redirect Path } =========
            // Test Error
            //    return 'Error ';
            return redirect()->back()
                ->with('erorr', "Can't Create Project Becouse Find Error ");
        };



        return redirect()->back()->with('success', 'تم حفظ المشروع بنجاح.');
    }
    abort(403, 'Unauthorized');

}


    // =========================== {  Update Tasks  } ===========================
    // public function updateProgramming(Request $request, $projectId)
    // {
    //     try {
    //         // $request->validate([
    //         //     'file_programming' => 'nullable|max:3028|mimes:jpg,jpeg,png,pdf',
    //         // ]);

    //         // Find the existing project
    //         $project = ProjectProgramming::findOrFail($projectId);

    //         // Update the project attributes
    //         $project->project_name = $request->input('project_name');
    //         $project->start_date = $request->input('start_date');
    //         $project->end_date = $request->input('end_date');
    //         $project->department = $request->input('department');
    //         $project->tmLeader = $request->input('tmLeader');
    //         $project->team = json_encode($request->input('team'));
    //         $project->creator_name = auth()->user()->name;
    //         $project->notespro = $request->input('notespro');

    //         // If Condition Image Or Pdf And Saving
    //         if ($request->hasFile('file_programming')) {
    //             $file = $request->file('file_programming');
    //             $fileExtension = $file->getClientOriginalExtension();

    //             if ($fileExtension == 'pdf') {
    //                 $pdfName = time() . '-' . $project->project_name . '-' . 'Marketing' . '.' . $fileExtension;
    //                 $file->move(public_path('images/manager/marketing/pdf'), $pdfName);
    //                 $path = $pdfName;
    //             } else {
    //                 $imageName = time() . '-' . $project->project_name . '-' . 'Marketing' . '.' . $fileExtension;
    //                 $file->move(public_path('images/manager/marketing/images'), $imageName);
    //                 $path =  $imageName;
    //             }

    //             // Save Value In Variable
    //             $project->file_programming = $path;
    //         }

    //         // Save Updated Data
    //         $project->save();
    //     } catch (Exception $e) {
    //         // Handle the exception as needed
    //         // dd($e->getMessage());

    //         return redirect()->back()
    //             ->with('error', "Can't update project due to an error.");
    //     }
    //     return redirect()->back()->with('success', 'تم تحديث المشروع بنجاح.');
    // }

    public function updateProgramming(Request $request, $projectId)
{
        if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department == 'programming')) {

    try {
        // Find the existing project
        $project = ProjectProgramming::findOrFail($projectId);

        // Update the project attributes
        $project->project_name = $request->input('project_name');
        $project->start_date = $request->input('start_date');
        $project->end_date = $request->input('end_date');
        $project->tmLeader = $request->input('tmLeader');
        $project->team = json_encode($request->input('team'));
        $project->creator_name = auth()->user()->name;
        $project->notespro = $request->input('notespro');

        // Check if 'department' is provided in the request
        if ($request->has('department')) {
            $project->department = $request->input('department');
        }

        // If Condition Image Or Pdf And Saving
        if ($request->hasFile('file_programming')) {
            $file = $request->file('file_programming');
            $fileExtension = $file->getClientOriginalExtension();

            if ($fileExtension == 'pdf') {
                $pdfName = time() . '-' . $project->project_name . '-' . 'Programming' . '.' . $fileExtension;
                $file->move(public_path('images/manager/programming/images'), $pdfName);
                $path = $pdfName;
            } else {
                $imageName = time() . '-' . $project->project_name . '-' . 'Programming' . '.' . $fileExtension;
                $file->move(public_path('images/manager/programming/images'), $imageName);
                $path =  $imageName;
            }

            // Save Value In Variable
            $project->file_programming = $path;
        }

        // Save Updated Data
        $project->save();
    } catch (Exception $e) {
        // Handle the exception as needed
        // dd($e->getMessage());
        return redirect()->back()
            ->with('error', "Can't update project due to an error.");
    }
    return redirect()->back()->with('success', 'تم تحديث المشروع بنجاح.');
}
abort(403, 'Unauthorized');

}

    // =========================== {  edit Tasks  } ===========================
    public function editPro(Request $request,$projectId)
    {
        if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department == 'programming')) {

        try {
            // Find the existing project
            $projectPro = ProjectProgramming::findOrFail($projectId);
            return view('manger.programming.editTaskPro', compact('projectPro'));

            }catch (Exception $e) {
                abort(404);
            }
    }
    abort(403, 'Unauthorized');

}

    // =========================== {  Show Project  } ===========================
    public function showProjectProgramming(ProjectProgramming $projectProgramming ){
        if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department == 'programming') || (auth()->user()->can('isEmployee') && auth()->user()->department == 'programming')) {

        $proProgramming = $projectProgramming->get();
        $proProgramming = $projectProgramming->get();

        $teamMembersDataPro = [];

        foreach ($proProgramming as $Market) {
            $teamMembers = [];

            foreach (json_decode($Market->team) as $teamMemberId) {
                $teamMembers[] = [
                    "id" => $teamMemberId,
                    "name" =>User::find($teamMemberId)->name,
                    "image" => User::find($teamMemberId)->image,
                ];
            }

            $teamleader = $Market->tmLeader;

            $teamMembersDataPro[] = [
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
                "file_marketing" => $Market->file_programming,
                "completion_percentage" => $Market->completion_percentage,
            ];
        }
            // return $teamMembersDataPro;
            return view('manger.programming.projectProgram', compact('teamMembersDataPro'));

        // return view('manger.programming.projectProgram' ,compact('proProgramming'));
    }
    abort(403, 'Unauthorized');

}



    public function updateProgramming2(Request $request, $projectId)
    {
        if (auth()->user()->can('isAdmin') || (auth()->user()->can('isManager') && auth()->user()->department == 'programming')) {

        try {
            $project = ProjectProgramming::findOrFail($projectId);
            $project->completion_percentage = $request->input('completion_percentage');
            $project->save();

            return response()->json(['success' => true, 'message' => 'تم تحديث القيمة بنجاح']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'حدث خطأ أثناء تحديث القيمة']);
        }
    }
    abort(403, 'Unauthorized');

}

          // ========================={{ Start Delete }}===================================

          public function destroy($id)
          {

              // Find the existing contract by ID
              $contract = ProjectProgramming::findOrFail($id);
              // Delete the contract
              $contract->delete();


              // Redirect or return a response indicating successful deletion
              return redirect()->back()
                  ->with('success', 'تم حذف المهمة بنجاح');

        }
          // ========================={{ End Delete }}===================================

}
