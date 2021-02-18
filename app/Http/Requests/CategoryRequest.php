<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CategoryRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            "category_name" => "required",
        ];
    }

    public function messages(){
        return [
            "category_name.required" => "category name is required",
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
