<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class test extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }



    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|max:12',
            'address' => 'required|string|max:255',
            'jobTitle' => 'required|string|max:100',
            'salary' => 'required|numeric',
            'gender' => 'required',
            'age' => 'required|date|before:2006-01-01',
            'department' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ];
    
        // Check Number Phone Don't Repeat
        $mobile = $this->input('mobile');
        $existingEmployee = User::where('mobile', $mobile)->first();
        if ($existingEmployee) {
            $rules['mobile'] = 'unique:users,mobile';
        }
    
        // Check Email Don't Repeat
        $email = $this->input('email');
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            $rules['email'] = 'unique:users,email';
        }
    
        return $rules;
    }

    // public function message()
    // {
    //     // Return Customer Message Error    
    //     return [
    //         'name.required' => 'يجب ادخال الاسم',
    //         'age.before' => 'يجب الا يقل عن 17 سنه',
    //         'amount.required' => 'يجب ادخال قيمة العقد',
    //         'contract_type.required' => 'يجب تحديد نوع العقد',
    //         'start_date.required' => 'يجب تحديد تاريخ بدايه العقد',
    //         'start_date.after_or_equal' => 'يجب ان لا يبداء العقد قبل السنه الحاليه ',
    //         'due_date.after_or_equal' => 'يجب ان لا يبداء العقد قبل السنه الحاليه ',
    //         'due_date.required' => 'يجب تحديد تاريخ نهاية العقد',
    //         'images.*.required' => 'يجب رفع صوره علي الاقل للعقد',
    //         'images.*.mimes' => 'يجب الالتزام بصيغ رفع الصوره (jpg,jpeg,png)',
    //         'mobile.unique' => 'رقم الهاتف مكرر.',
    //         'email.unique' => 'هذا الاميل موجود',

    //     ];
    // }
}
