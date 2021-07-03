<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService 
{
    private $userRepository;

    public function __construct(){

        $this->userRepository = new UserRepository();
    }

    public function register(array $data){

        $data['password'] = bcrypt($data['password']);

        $user = $this->userRepository->create($data);

        $token = $user->createToken('login')->plainTextToken;
        
        return [
            'user'=>$user,
            'token' => $token
        ];
    }

    public function login(array $data){
      
        $user = $this->userRepository->findByEmail($data['email']);
     
        if(!$user || !Hash::check($data['password'], $user->password)){
            return null;
        }

        $token = $user->createToken('login')->plainTextToken;

        return [
            'user'=>$user,
            'token' => $token
        ];

        
    }
    public function logout(Request $request){
        
        auth()->user()->tokens()->delete();
    }
}
