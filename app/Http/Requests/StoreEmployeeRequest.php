<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'mobile' => 'required|unique:user_personal_informations',
            'address' => 'required',
            'gender' => 'required',
            'email' => 'required|Email',
            'date_of_birth' => 'required|date',
            'designation' => 'required',
            'salary' => 'required',
            'join_date' => 'required|date',
        ];
    }
}
