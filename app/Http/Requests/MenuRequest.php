<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MenuRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'boolean',
            'menu_category_id' => 'required|exists:menu_categories,id',
        ];
    }

    public function messages(){
        return [
            "name.required" => "name is required",
            "price.required" => "price is required",
            "status.boolean" => "input must be true or false",
            "description.required" => "description is required",
            "menu_category_id.required" => "menu_category_id is required",
            "menu_category_id.exists" => "not a valid menu_category_id",
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors(),
            'message' => 'one or more fields are required or not entered properly'
        ]), 422);
        
    }
}
