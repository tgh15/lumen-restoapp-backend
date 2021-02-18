<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;
use App\Http\Services\UtilityService;
use Tymon\JWTAuth\Exceptions\TokenExpiredExceptions;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    protected $admin;
    protected $utilityService;

    public function __construct(){
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
        $this->admin = new Admin;
        $this->utilityService = new UtilityService;
    }

    public function register(AdminRegisterRequest $request){
        $password_hash = $this->utilityService->hash_password($request->password);
        $this->admin->createAdmin($request, $password_hash);
        $success_message = "Registration successfully";
        return $this->utilityService->is200Response($success_message);
    }

    public function login(AdminLoginRequest $request){

        $credentials = $request->only(['email', 'password']);
        
        if (!$token = Auth::guard('admin')->attempt($credentials)) {
            $responseMessage = "invalid email or password";
            return $this->utilityService->is422Response($responseMessage);
        }
        return $this->responseWithToken($token);
    }

    public function viewProfile(){
        
    }
}
