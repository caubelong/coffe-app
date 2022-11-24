<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserValidated extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name'=>'required|min:3|max:20|unique:user,name,'.$this->id,
            'email'=>'required|email|unique:user,email,'.$this->id,
            'password'=>'required|',
            'role_id'=>'required|numeric',
            'isActive'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>"name is required",
            'name.min'=>'name not be less than 03 characters',
            'name.max'=>'name no more than 20 characters',
            'name.unique'=>"name already exists",
            'email.required'=>"email is required",
            'email.email'=>"email is not format",
            'email.unique'=>"email already exists",
            'password.required'=>"password is required",
            'isActive.required'=>"status is required",
        ];
    }
}
