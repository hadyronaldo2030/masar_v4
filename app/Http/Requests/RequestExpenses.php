<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestExpenses extends FormRequest
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
         // Valdations Expeenses 
         $rules = [
            'amount'          => 'required',
            'start_date'      => 'required|date', 
            'due_date'        => 'required|date|after:start_date' ,
            'invoice_type'   => 'required' ,
            'notes'           => 'nullable',
            'image'          => 'required|max:2028|mimes:jpg,jpeg,png',
        ];
        return $rules;

    }

    public function message()
    {
        // Return Customer Message Error    
        return [
            'amount.required' => 'يجب ادخال قيمة الفاتوره  ',
            'invoice_type.required' => 'يجب تحديد نوع الفاتورة',
            'start_date.required' => 'يجب تحديد تاريخ بدايه الفاتورة',
            'due_date.required' => 'يجب تحديد تاريخ نهاية الفاتورة',
            'due_date.after' => 'يجب ان ينتهي الفاتورة بعد تاريخ بدايته',
            'image.required' => 'يجب رفع صوره علي الاقل للفاتورة',
        ];
    }
}
