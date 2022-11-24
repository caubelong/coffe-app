<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToppingValidated extends FormRequest
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
            'name'=>'required|min:3|max:20|unique:topping,name,'.$this->id,
            'price'=>'required|numeric|min:0',
            'discount'=>'required|numeric|max:100|min:0',
            'status'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>"name is required",
            'name.min'=>'name not be less than 03 characters',
            'name.max'=>'name no more than 20 characters',
            'name.unique'=>"name already exists",
            'price.unique'=>"price is required",
            'price.numeric'=>"price is number",
            'price.min'=>"price not be less than 0",
            'discount.required'=>"discount is required",
            'discount.numeric'=>"discount is number",
            'discount.min'=>"discount not less than 0 ",
            'discount.max'=>"discount no more than 100",
            'status.required'=>"status is required"
        ];
    }
}
