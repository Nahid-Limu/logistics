<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public $HTTP_STATUS  = 200;
    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success_token['token'] = $user->createToken('SELS')->accessToken;
            return response()->json(['success'=>$success_token],$this->HTTP_STATUS);
        }else{
            return response()->json(['error' => 'Unauthorized','message'=>'Please enter valid email and password'],401);
        }
    }


    /**
     * User logout method
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'success' => 'Successfully logged out'
        ]);
    }


}
