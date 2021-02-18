<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminRegisterRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            "name" => "required",
            "email" => "required|email|unique:admins",
            "password" => "required|min:8"
        ];
    }

    public function messages(){
        return [
            "name.required" => "name is required",
            "email.required" => "email is required",
            "email.email" => "enter a valid email",
            "email.unique" => "use another email",
            "password.required" => "password is required",
            "password.min" => "password must be 8 character or above"
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