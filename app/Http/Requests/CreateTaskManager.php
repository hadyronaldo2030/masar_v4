<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskManager extends FormRequest
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
            'project_name'  => 'required',
            'start_date'  => 'required|date',
            // 'due_date'  => 'required|date|after_or_equal:start_date',
            'department'   => 'required',
            'file_marketing' => 'required|max:3028|mimes:jpg,jpeg,png,pdf',
            'department' => 'required',
            'team' => 'required',
            'tmLeader' => 'required',
            'notesmar' => 'nullable',
        ];
        return $rules;
    }

    public function message()
    {
        // Return Customer Message Error    
        return [
            'project_name.required' => 'Please enter the project name.',
            'start_date.required' => 'Please select the start date.',
            'start_date.date' => 'Invalid date format for the start date.',
            // 'due_date.required' => 'Please select the end date.',
            // 'due_date.date' => 'Invalid date format for the end date.',
            // 'due_date.after' => 'The end date must be after the start date.',
            'department.required' => 'Please select the department.',
            'file_marketing.required' => 'Please attach a file (image or PDF).',
            'file_marketing.max' => 'The file size must not exceed 3028 KB.',
            'file_marketing.mimes' => 'The file must be an image (jpg, jpeg, png) or a PDF.',
            'team.required' => 'Please select at least one team member.',
            'tmLeader.required' => 'Please select the team leader.',
            'notesmar.nullable' => 'Invalid format for notesmar.',
        ];
    }
}