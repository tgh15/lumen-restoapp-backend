<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\UtilityService;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use Tymon\JWTAuth\Exceptions\TokenExpiredExceptions;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    protected $user;

    protected $utilityService;

    public function __construct(){
        $this->middleware('auth:user', ['except' => ['login', 'register']]);
        $this->user = new User;
        $this->utilityService = new UtilityService;
    }

    public function register(UserRegisterRequest $request){
        $password_hash = $this->utilityService->hash_password($request->password);
        $this->user->createUser($request, $password_hash);
        $success_message = "Registration successfully";
        return $this->utilityService->is200Response($success_message);
    }

    public function login(UserLoginRequest $request){

        $credentials = $request->only(['email', 'password']);
        
        if (!$token = Auth::guard('user')->attempt($credentials)) {
            $responseMessage = "invalid email or password";
            return $this->utilityService->is422Response($responseMessage);
        }
        return $this->responseWithToken($token);
    }

    public function viewProfile(){
        $responseMessage = "user profile";
        $data = Auth::guard('user')->user();
        return $this->utilityService->is200ResponseWithData($responseMessage, $data);
    }
}
