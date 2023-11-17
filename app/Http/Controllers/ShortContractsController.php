<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestShortContracts;
use App\Models\Revenue;
use App\Models\ShortContracts;
use Illuminate\Http\Request;

class ShortContractsController extends Controller
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

    // ========================={{ Start Save }}===================================

    public function store(RequestShortContracts $request)
    {
        // Test Request
        // dd($request->file('images'));
        // dd($request->all());

        // Get Data In form
        $dataInsertRevenue['name'] = $request->name;
        $dataInsertRevenue['amount'] = $request->amount;
        $dataInsertRevenue['start_date'] = $request->start_date;
        $dataInsertRevenue['due_date'] = $request->due_date;
        $dataInsertRevenue['contractShort_type'] = $request->contractShort_type;
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
                $request->$inputName->move(public_path('images/shortContracts'), $imageName);
                $images[] = $imageName;
                $dataInsertRevenue['image' . $i] = $imageName;
            }
        }

        // Save the Data
        $revenue = new ShortContracts($dataInsertRevenue);
        $revenue->save();

        // Redirect or return a response indicating successful save
        return redirect()->route('admin.fiances.revenues')
            ->with('success', 'تم حفظ العقد بنجاح');
    }
    // ========================={{ End Save }}===================================

    // ========================={{ Start Show Shortcontract }}===================================
    public function showShortcontract(string $id)
    {
        // Get Id Revenues
        $shortContracts = ShortContracts::findOrFail($id);

        // Test
        // dd($revenuesBasic);

        // Show Id Employee page without edit
        return view('admin.fiances.editShortContracts', compact('shortContracts'));
    }
    // ========================={{ End Show Shortcontract }}===================================


    // ========================={{ Start Update }}===================================
    public function updateShortcontract(Request $request, $id)
    {
        // Find the revenue record by its ID
        $revenueShortContracts = ShortContracts::find($id);

        if (!$revenueShortContracts) {
            return redirect()->back()->with('error', 'لم يتم العثور على العقد');
        }

        // Update Data In form
        $revenueShortContracts->name = $request->name;
        $revenueShortContracts->amount = $request->amount;
        $revenueShortContracts->start_date = $request->start_date;
        $revenueShortContracts->due_date = $request->due_date;
        $revenueShortContracts->contractShort_type = $request->contractShort_type;
        $revenueShortContracts->notes = $request->notes;

        // Update images if uploaded
        for ($i = 1; $i <= 10; $i++) {
            $inputName = 'image' . $i;
            if ($request->hasFile($inputName)) {
                $imageName = time() . $i . '.' . $request->$inputName->getClientOriginalName();
                $request->$inputName->move(public_path('images/shortContracts'), $imageName);
                $revenueShortContracts->{'image' . $i} = $imageName;
            }
        }

        // Save the updated data
        $revenueShortContracts->save();

        // Redirect or return a response indicating successful update
        return redirect('/admin/finance/revenues')
            ->with('success', 'تم تحديث العقد بنجاح');
    }
    // ========================={{ End Update }}===================================

    // ========================={{ Start Delete }}===================================

    public function destroy($id)
    {
        // Find the existing contract by ID
        $contract2 = ShortContracts::findOrFail($id);

        // Loop through images and delete them
        // for ($i = 1; $i <= 10; $i++) {
        //     $imageField = 'image' . $i;
        //     $imageName = $contract2->$imageField;

        //     if (!empty($imageName)) {
        //         // Delete the image file
        //         $imagePath = public_path('images/shortContracts/' . $imageName);
        //         if (file_exists($imagePath)) {
        //             unlink($imagePath);
        //         }
        //     }
        // }

        // Delete the contract
        $contract2->delete();


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
        $revenuesData = Revenue::all();
        // $shortContracts = ShortContracts::all();

        // process Filter
        $shortContracts = ShortContracts::whereDate('start_date','>=',$start_date)
        ->whereDate('due_date','<=',$end_date)
        ->get();

        return view('admin.fiances.revenues', compact('revenuesData','shortContracts'));
    }
    // ========================={{ End Filter }}===================================

}
