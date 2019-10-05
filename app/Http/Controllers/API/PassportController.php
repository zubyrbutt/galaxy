<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class PassportController extends Controller
{
    public $successStatus=200;

    public function login(){
        $loginData=array(
            'email'=>request('email'),
            'password'=>request('password')
        );
        if(Auth::attempt($loginData)){
            $user=Auth::user();
            $success['token']=$user->createToken('MyApp')->accessToken;
            return response()->json(['success'=> $success], $this->successStatus);
        }else{
            return response()->json(['error'=>'Unatehnticated'],401);
        }
    }

    public function profileinfo(){
            $user=Auth::user();
            return response()->json(['success'=> $user], $this->successStatus);
        
    }
}
