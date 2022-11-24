<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Role;
class RoleValidated extends FormRequest
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
            'name'=>"required|max:20|min:3|unique:role,name,".$this->id
            // {$this->id} sử dụng id để xác định role khi update, nếu dữ liệu thay đổi mà name role không thay đổi sẽ k bị unique
        ];
    }
    public function messages()
    {

        return [
            'name.required'=>"name is required",
            'name.unique'=>"name already exists",
            'name.max'=>"name no more than 20 characters",
            'name.min'=>"name not be less than 03 characters "
        ];
    }
//    public function failedValidation(Validator $validator)
//
//    {
//        throw new HttpResponseException(response()->json([
//            'success'   => false,
//            'message'   => 'Validation errors',
//            'data'      => $validator->errors()
//        ]));
//
//    }
}
