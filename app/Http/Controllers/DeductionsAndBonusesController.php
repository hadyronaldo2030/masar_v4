<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\DeductionsAndBonuses;
use Illuminate\Http\Request;

class DeductionsAndBonusesController extends Controller
{

    public function store(Request $request)
    {
        //Test 
        //dd($request->all());
        // Set Feild Data In Database (Save)
        $dataInsertAction['employee_id'] = $request->employee_id;
        $dataInsertAction['attendance_day_id'] = $request->attendance_day_id;
        $dataInsertAction['notes'] = $request->notes;
        $dataInsertAction['status'] = $request->status;
        $dataInsertAction['price'] = $request->price;
        $dataInsertAction['creator_name'] = auth()->user()->name;

        // Save Data
        DeductionsAndBonuses::create($dataInsertAction);

        // Update the entry_date for the attendance day
        $attendanceDay = Attendance::find($request->attendance_day_id);
        $attendanceDay->entry_date = now();
        $attendanceDay->save();

        // Redirect or return a response indicating successful save
        return redirect()->back()
            ->with('success', 'تم حفظ  بنجاح');
    }





    public function destroy(string $id)
    {
        // Authorize
        if (auth()->user()->can('isAdmin') || auth()->user()->can('isHr') || auth()->user()->can('isDataEntry')) {

        // Get DeductionsAndBonuses 
        $DeductionsAndBonuses = DeductionsAndBonuses::findOrFail($id);

        // Delete Data Employee
        $DeductionsAndBonuses->delete();
        return redirect()->back()->with('success', 'تم حذف  بنجاح.');
    }else{
        abort(403, 'Unauthorized');
    }
}
}
