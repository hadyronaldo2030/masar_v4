<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;
use App\Http\Requests\RequestRevenue;

use App\Models\ShortContracts;
use Exception;

class RevenueController extends Controller
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

    // ========================={{ Start Index }}===================================
    public function index()
    {
        // Get All Data Revenues
        $revenuesData = Revenue::all();
        $shortContracts = ShortContracts::all();

        // Test Data
        // dd($revenuesData);


        return view('admin.fiances.revenues', compact('revenuesData', 'shortContracts'));
    }

    // ========================={{ End Index }}===================================



    // ========================={{ Start Save }}===================================

    public function storebasic(RequestRevenue $request)
    {
        // Test Request
        // dd($request->file('images'));
        // dd($request->all());

        // Get Data In form
        $dataInsertRevenue['name'] = $request->name;
        $dataInsertRevenue['amount'] = $request->amount;
        $dataInsertRevenue['start_date'] = $request->start_date;
        $dataInsertRevenue['due_date'] = $request->due_date;
        $dataInsertRevenue['contract_type'] = $request->contract_type;
        $dataInsertRevenue['notes'] = $request->notes;
        $dataInsertRevenue['image1'] = $request->image1;
        $dataInsertRevenue['image2'] = $request->image2 ?? '';
        $dataInsertRevenue['image3'] = $request->image3 ?? '';
        $dataInsertRevenue['image4'] = $request->image4 ?? '';
        $dataInsertRevenue['image5'] = $request->image5 ?? '';
        $dataInsertRevenue['image6'] = $request->image6 ?? '';
        $dataInsertRevenue['image7'] = $request->image7 ?? '';
        $dataInsertRevenue['image8'] = $request->image8 ?? '';
        $dataInsertRevenue['image9'] = $request->image9 ?? '';
        $dataInsertRevenue['image10'] = $request->image10 ?? '';
        $dataInsertRevenue['creator_name'] = auth()->user()->name;

        // ========= {Method Image upload} =========
        $images = [];

        for ($i = 1; $i <= 10; $i++) {
            $inputName = 'image' . $i;
            if ($request->hasFile($inputName)) {
                $imageName = time() . $i . '.' . $request->$inputName->getClientOriginalName();
                $request->$inputName->move(public_path('images/revenue'), $imageName);
                $images[] = $imageName;
                $dataInsertRevenue['image' . $i] = $imageName;
            }
        }

        // Save the Data
        $revenue = new Revenue($dataInsertRevenue);
        $revenue->save();

        // Redirect or return a response indicating successful save
        return redirect()->back()
            ->with('success', 'تم حفظ العقد بنجاح');
    }
    // ========================={{ End Save }}===================================

    // ========================={{ Start Show basic }}===================================
    public function showBasic(string $id)
    {
        // Get Id Revenues
        $revenuesBasic = Revenue::findOrFail($id);

        // Test
        // dd($revenuesBasic);

        // Show Id Employee page without edit
        return view('admin.fiances.editrevenues', compact('revenuesBasic'));
    }
    // ========================={{ End Show basic }}===================================


    // ========================={{ Start Update }}===================================
    public function updateBasic(Request $request, $id)
{
    // Find the revenue record by its ID
    $revenue = Revenue::find($id);

    if (!$revenue) {
        return redirect()->back()->with('error', 'لم يتم العثور على العقد');
    }

    // Update Data In form
    $revenue->name = $request->name;
    $revenue->amount = $request->amount;
    $revenue->start_date = $request->start_date;
    $revenue->due_date = $request->due_date;
    $revenue->contract_type = $request->contract_type;
    $revenue->notes = $request->notes;

    // Update images if uploaded
    for ($i = 1; $i <= 10; $i++) {
        $inputName = 'image' . $i;
        if ($request->hasFile($inputName)) {
            $imageName = time() . $i . '.' . $request->$inputName->getClientOriginalName();
            $request->$inputName->move(public_path('images/revenue'), $imageName);
            $revenue->{'image' . $i} = $imageName;
        }
    }

    // Save the updated data
    $revenue->save();

    // Redirect or return a response indicating successful update
    return redirect('/admin/finance/revenues')
        ->with('success', 'تم تحديث العقد بنجاح');
}

    // ========================={{ End Update }}===================================


    // ========================={{ Start Chckbox }}===================================
    public function updateChckbox(Request $request, $id)
{
    $revenue = Revenue::find($id);
    $revenue->update([
       'checkbox_field' => $request->input('checkbox_field')
    ]);
    return response()->json(['message' => 'تم تحديث الـ checkbox بنجاح']);
}


    // ========================={{ End Chckbox }}===================================



    // ========================={{ Start Delete }}===================================

    public function destroy($id)
    {
        // Find the existing contract by ID
        $contract = Revenue::findOrFail($id);

        // Loop through images and delete them
        // for ($i = 1; $i <= 10; $i++) {
        //     $imageField = 'image' . $i;
        //     $imageName = $contract->$imageField;

        //     if (!empty($imageName)) {
        //         // Delete the image file
        //         $imagePath = public_path('images/revenue/' . $imageName);
        //         if (file_exists($imagePath)) {
        //             unlink($imagePath);
        //         }
        //     }
        // }

        // Delete the contract
        $contract->delete();


        // Redirect or return a response indicating successful deletion
        return redirect()->back()
            ->with('success', 'تم حذف العقد بنجاح');
    }
    // ========================={{ End Delete }}===================================




    // ========================={{ Start Filter }}===================================
    public function filter(Request $request)
    {
        // Get Date Filter
        $start_date =$request->start_date;
        $end_date =$request->end_date;
        // $revenuesData = Revenue::all();
        $shortContracts = ShortContracts::all();

        // process Filter
        $revenuesData = Revenue::whereDate('start_date','>=',$start_date)
        ->whereDate('due_date','<=',$end_date)
        ->get();

        return view('admin.fiances.revenues', compact('revenuesData','shortContracts'));
    }
    // ========================={{ End Filter }}===================================
    
    // ========================={{ Start Checkbox }}===================================
    public function updateCheckbox(Request $request, $id)
    {
        $revenue = Revenue::find($id);
        // dd($request->all());

        if (!$revenue) {
            return redirect()->back()
            ->with('error', 'يوجد مشكله في تحديث الحاله العقد');
        }

        $revenue->checkbox_field = $request->input('checkbox_field') == "on"? 1:0;
        // dd($revenue->checkbox_field);
        $revenue->save();

        return redirect()->back()
        ->with('success', 'تم تحديث حاله العقد');
    }

    // ========================={{ End Checkbox }}===================================


}
