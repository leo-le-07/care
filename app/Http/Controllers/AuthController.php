<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    private $authService;

    public function __construct(){
        $this->authService = new AuthService();
    }


    public function register(Request $request){
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|string|unique:users,email',
            'password'=>'required|string|min:3'
        ]);

        $data = $request->only(['name','email','password']);

        $result = $this->authService->register($data);

        if(!$result){
            return $this->errorResponse('Can not register', 500);
        }
        return $this->successResponse($result, 'Register successfully');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|string',
            'password'=>'required|string|min:3'
        ]);

        $data = $request->only(['email','password']);

        $result = $this->authService->login($data);

        if(!$result){
            return $this->errorResponse('Login fail', 201);
        }
        return $this->successResponse($result, 'Login successfully');
        
    }
    public function logout(Request $request){

       $this->authService->logout($request);
      
       return $this->successResponse(null, 'Logout');
    }
}
