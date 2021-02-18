<?php

namespace App\Http\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;

class UtilityService
{
    public function is200Response($responseMessage){
        throw new HttpResponseException(response()->json([
            "success" => true,
            "message" => $responseMessage
        ]), 200);
    }

    public function is200ResponseWithData($responseMessage, $data){
        throw new HttpResponseException(response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" => $data
        ]), 200);
    }

    public function is422Response($responseMessage){
        throw new HttpResponseException(response()->json([
            "success" => false,
            "message" => $responseMessage
        ]), 422);
    }
    public function is500Response($responseMessage){
        throw new HttpResponseException(response()->json([
            "success" => false,
            "error" => $responseMessage,
            "message" => $responseMessage
        ]), 500);
    }
    public function is401Response(){
        throw new HttpResponseException(response()->json([
            "success" => false,
            "error" => 'unauthenticated',
            "message" => 'unathenticated'
        ]), 401);
    }

    public function is404Response($responseMessage){
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => 'not found',
            'message' => $responseMessage
        ]), 404);
    }

    public function hash_password($password){
        return Hash::make($password);
    }
}
