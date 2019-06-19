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
            if(Auth::user()->is_permission==1){
                $success_token['user_type']="super";
            }
            if(Auth::user()->is_permission==2){
                $success_token['user_type']="admin";
            }
            if(Auth::user()->is_permission==3){
                $success_token['user_type']="employee";
            }
            if(Auth::user()->is_permission==4){
                $success_token['user_type']="vendor";
            }
            if(Auth::user()->is_permission==5){
                $success_token['user_type']="executive";
            }
            if(Auth::user()->is_permission==6){
                $success_token['user_type']="driver";
            }
            return response()->json(['success'=>$success_token],200);
        }else{
            return response()->json(['error'=>'Access Denied']);
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
