<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'employee_id'=>'required',
            'employee_email'=>'required',
            'employee_name'=>'required',
            'mobile'=>'required|numeric|digits:10',
            'status'=>'required',
            'designation'=>'required',
            'department'=>'required',
            'joiningdate'=>'required',
            'gender'=>'required',
            'address'=>'required'
        ];
    }
}
