<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestExpenses;
use App\Models\Expenses;
use App\Models\Pettycash;
use Illuminate\Http\Request;

class ExpensesController extends Controller
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
        // Get All Data Expenses
        $expensesData = Expenses::all();
        // Get All Data pettycash
        $pettycashData = Pettycash::all();

        // Test Data
        // dd($expensesData);


        return view('admin.fiances.expenses', compact('expensesData', 'pettycashData'));
    }

    // ========================={{ End Index }}===================================


    // ========================={{ Start Save }}===================================

    public function store(RequestExpenses $request)
    {
        // Test Request
        // dd($request->file('images'));
        // dd($request->all());

        // Get Data In form
        $dataInsertExpenses['amount'] = $request->amount;
        $dataInsertExpenses['start_date'] = $request->start_date;
        $dataInsertExpenses['due_date'] = $request->due_date;
        $dataInsertExpenses['invoice_type'] = $request->invoice_type;
        $dataInsertExpenses['notes'] = $request->notes;
        $dataInsertExpenses['image'] = $request->image;
        $dataInsertExpenses['creator_name'] = auth()->user()->name;

        // ========= {Method Image upload} =========
        $images = [];
        $inputName = 'image';
        if ($request->hasFile($inputName)) {
            $imageName = time() . ' - ' . 'expenses' . '.' . $request->$inputName->getClientOriginalName();
            $request->$inputName->move(public_path('images/expenses'), $imageName);
            $images[] = $imageName;
            $dataInsertExpenses['image'] = $imageName;
        }

        // Save the Data
        $expenses = new Expenses($dataInsertExpenses);
        $expenses->save();

        // Redirect or return a response indicating successful save
        return redirect()->back()
            ->with('success', 'تم حفظ الفاتورة بنجاح');
    }
    // ========================={{ End Save }}===================================

    // ========================={{ Start Edit Expensess }}===================================
    public function showExpences(string $id)
    {
        // Get Id Revenues
        $expensesData = Expenses::findOrFail($id);

        // Test
        // dd($revenuesBasic);

        // Show Id Employee page without edit
        return view('admin.fiances.editexpenses', compact('expensesData'));
    }
    // ========================={{ End Edit Expensess }}===================================


    // ========================={{ Start Update Expensess }}===================================

    public function updateExpences(Request $request, $id)
    {
        // Find the expenses record by its ID
        $expensesUpdate = Expenses::find($id);

        if (!$expensesUpdate) {
            return redirect()->back()->with('error', 'لم يتم العثور على الفاتوره');
        }

        // Update Data In form
        $expensesUpdate->amount = $request->amount;
        $expensesUpdate->start_date = $request->start_date;
        $expensesUpdate->due_date = $request->due_date;
        $expensesUpdate->invoice_type = $request->invoice_type;
        $expensesUpdate->notes = $request->notes;

        // Update image if uploaded
        $inputName = 'image';
        if ($request->hasFile($inputName)) {
            $imageName = time() . ' - ' . 'expenses' . '.' . $request->$inputName->getClientOriginalName();
            $request->$inputName->move(public_path('images/expenses'), $imageName);
            $expensesUpdate->image = $imageName;
        }

        // Save the updated data
        $expensesUpdate->save();

        // Redirect or return a response indicating successful update
        return redirect('/admin/finance/expenses')
            ->with('success', 'تم تحديث الفاتوره بنجاح');
    }

    // ========================={{ End Update Expensess }}===================================

    // ========================={{ Start Delete }}===================================

    public function destroy($id)
    {
        // Find the existing contract by ID
        $contract = Expenses::findOrFail($id);

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
            ->with('success', 'تم حذف الفاتورة بنجاح');
    }
    // ========================={{ End Delete }}===================================




    // ========================={{ Start Filter }}===================================
    public function filter(Request $request)
    {
        // Get Date Filter
        $start_date =$request->start_date;
        $end_date =$request->end_date;
        // $expensesData = Expenses::all();
        // Get All Data pettycash
        $pettycashData = Pettycash::all();

        // process Filter
        $expensesData = Expenses::whereDate('start_date','>=',$start_date)
        ->whereDate('due_date','<=',$end_date)
        ->get();

        return view('admin.fiances.expenses', compact('expensesData','pettycashData'));
    }
    // ========================={{ End Filter }}===================================

}
