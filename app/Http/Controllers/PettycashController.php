<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestPetyCash;
use App\Models\Expenses;
use App\Models\Pettycash;
use Illuminate\Http\Request;

class PettycashController extends Controller
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

    public function storepetty(RequestPetyCash $request)
    {
        // Test Request
        // dd($request->file('images'));
        // dd($request->all());

        // Get Data In form
        $dataInsertExpenses['amount'] = $request->amount;
        $dataInsertExpenses['start_date'] = $request->start_date;
        $dataInsertExpenses['due_date'] = $request->due_date;
        $dataInsertExpenses['invoicepetty_type'] = $request->invoicepetty_type;
        $dataInsertExpenses['notes'] = $request->notes;
        $dataInsertExpenses['image'] = $request->image;
        $dataInsertExpenses['creator_name'] = auth()->user()->name;


        // ========= {Method Image upload} =========
        $images = [];
        $inputName = 'image';
        if ($request->hasFile($inputName)) {
            $imageName = time() . ' - ' . 'expenses' . '.' . $request->$inputName->getClientOriginalName();
            $request->$inputName->move(public_path('images/pettycash'), $imageName);
            $images[] = $imageName;
            $dataInsertExpenses['image'] = $imageName;
        }

        // Save the Data
        $expenses = new Pettycash($dataInsertExpenses);
        $expenses->save();

        // Redirect or return a response indicating successful save
        return redirect('/admin/finance/expenses')
            ->with('success', 'تم حفظ النسريات بنجاح');
    }
    // ========================={{ End Save }}===================================

    // ========================={{ Start Edit Petty Cash }}===================================
    public function showPettycash(string $id)
    {
        // Get Id Revenues
        $pettycashData = Pettycash::findOrFail($id);

        // Test
        // dd($revenuesBasic);

        // Show Id Employee page without edit
        return view('admin.fiances.editpettycach', compact('pettycashData'));
    }
    // ========================={{ End Edit Petty Cash }}===================================


    // ========================={{ Start Update Expensess }}===================================

    public function updatePettycash(Request $request, $id)
    {
        // Find the expenses record by its ID
        $pettycashUpdate = Pettycash::find($id);

        if (!$pettycashUpdate) {
            return redirect()->back()->with('error', 'لم يتم العثور على النسريات');
        }

        // Update Data In form
        $pettycashUpdate->amount = $request->amount;
        $pettycashUpdate->start_date = $request->start_date;
        $pettycashUpdate->due_date = $request->due_date;
        $pettycashUpdate->invoicepetty_type = $request->invoicepetty_type;
        $pettycashUpdate->notes = $request->notes;

        // Update image if uploaded
        $inputName = 'image';
        if ($request->hasFile($inputName)) {
            $imageName = time() . ' - ' . 'expenses' . '.' . $request->$inputName->getClientOriginalName();
            $request->$inputName->move(public_path('images/pettycash'), $imageName);
            $pettycashUpdate->image = $imageName;
        }

        // Save the updated data
        $pettycashUpdate->save();

        // Redirect or return a response indicating successful update
        return redirect('/admin/finance/expenses')
            ->with('success', 'تم تحديث النسريات بنجاح');
    }

    // ========================={{ End Update Expensess }}===================================


    // ========================={{ Start Delete }}===================================

    public function destroy($id)
    {
        // Authorize
       $this->authorize('isAdmin','isFinance');

        // Find the existing contract by ID
        $contract = Pettycash::findOrFail($id);

        // Loop through images and delete them
        // for ($i = 1; $i <= 10; $i++) {
        //     $imageField = 'image' . $i;
        //     $imageName = $contract->$imageField;

        //     if (!empty($imageName)) {
        //         // Delete the image file
        //         $imagePath = public_path('images/expenses/' . $imageName);
        //         if (file_exists($imagePath)) {
        //             unlink($imagePath);
        //         }
        //     }
        // }

        // Delete the contract
        $contract->delete();


        // Redirect or return a response indicating successful deletion
        return redirect()->back()
        ->with('success', 'تم حذف النسريات بنجاح');
    }
    // ========================={{ End Delete }}===================================




    // ========================={{ Start Filter }}===================================
    public function filter(Request $request)
    {

        // Get Date Filter
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $expensesData = Expenses::all();
        // Get All Data pettycash
        // $pettycashData = Pettycash::all();

        // process Filter
        $pettycashData = Pettycash::whereDate('start_date', '>=', $start_date)
            ->whereDate('due_date', '<=', $end_date)
            ->get();

        return view('admin.fiances.expenses', compact('expensesData', 'pettycashData'));
    }
    // ========================={{ End Filter }}===================================

}
