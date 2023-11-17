<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestShortContracts extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
         // Valdations Revenue 
         $rules = [
            'name'            => 'required|string|max:255',
            'amount'          => 'required',
            'start_date'      => 'required|date', 
            'due_date'        => 'required|date|after:start_date' ,
            'contractShort_type'   => 'required' ,
            'notes'           => 'nullable',
            'image1'          => 'required|max:2028|mimes:jpg,jpeg,png',
            'image2'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image3'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image4'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image5'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image6'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image7'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image8'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image9'          => 'nullable|max:2028|mimes:jpg,jpeg,png',
            'image10'         => 'nullable|max:2028|mimes:jpg,jpeg,png',
        ];
        return $rules;
    }

    public function message()
    {
        // Return Customer Message Error    
        return [
            'name.required' => 'يجب ادخال الاسم',
            'amount.required' => 'يجب ادخال قيمة العقد',
            'contractShort_type.required' => 'يجب تحديد نوع العقد',
            'start_date.required' => 'يجب تحديد تاريخ بدايه العقد',
            'due_date.required' => 'يجب تحديد تاريخ نهاية العقد',
            'due_date.after' => 'يجب ان ينتهي العقد بعد تاريخ بدايته',
            'image1.required' => 'يجب رفع صوره علي الاقل للعقد',
        ];
    }
}
