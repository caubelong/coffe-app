<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserValidated;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //
    public function register(Request $request){
       $user = User::create([
           'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->role_id,
       ]);
       return response()->json([
           'status'=>true,
           'message'=>"User create successfully",
           'token'=>$user->createToken("API TOKEN")->plainTextToken
       ],200);
    }
    public function login(Request $request){
       if(!Auth::attempt($request->only(['email','password']))){
           throw ValidationException::withMessages([
              'email'=>['email provided credentials are incorrect']
           ]);
       }
       $user = User::where('email',$request->email)->first();
        return response()->json([
            'status'=>true,
            'message'=>"User login successfully",
            'token'=>$user->createToken("API TOKEN")->plainTextToken
        ],200);
    }
    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['msg'=>'log out succsess']);
    }
}
