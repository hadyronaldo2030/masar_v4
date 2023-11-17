<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPetyCash extends FormRequest
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
       // Valdations petty Cash 
       $rules = [
        'amount'          => 'required',
        'start_date'      => 'required|date', 
        // 'due_date'        => 'required|date|after:start_date' ,
        'due_date'        => 'required|date',
        'invoicepetty_type'   => 'required' ,
        'notes'           => 'nullable',
        'image'          => 'required|max:2028|mimes:jpg,jpeg,png',
    ];
    return $rules;
    }

    public function message()
    {
        // Return Customer Message Error    
        return [
            'amount.required' => 'يجب ادخال قيمة النسريات  ',
            'invoicepetty_type.required' => 'يجب تحديد نوع النسريات',
            'start_date.required' => 'يجب تحديد تاريخ بدايه النسريات',
            'due_date.required' => 'يجب تحديد تاريخ نهاية النسريات',
            'due_date.after' => 'يجب ان ينتهي النسريات بعد تاريخ بدايته',
            'image.required' => 'يجب رفع صوره علي الاقل للنسريات',
        ];
    }
}
