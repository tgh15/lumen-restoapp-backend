<?php

namespace App\Http\Requests;

use Urameshibr\Requests\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserLoginRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            "email" => "required|email",
            "password" => "required|min:8"
        ];
    }

    public function messages(){
        return [
            "email.required" => "email is required",
            "email.email" => "enter a valid email",
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
