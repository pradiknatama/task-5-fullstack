<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;



class ApiController extends Controller
{
    public function register(Request $request)
    {
        //validate data
        $data=$request->only('name','email','password');
        $validator=Validator::make($data,[
            'name'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|string|min:6|max:50'
        ]);
        //send failed response if request is not valid
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        //request is valid, create new user
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password)
        ]);
        //User created, return succes response
        return  response()->json([
            'success'=>true,
            'message'=>'User created successfully',
            'data'=>$user
        ],Response::HTTP_OK);
    }
    public function authenticate(Request $request)
    {
        $credentials=$request->only('email','password');
        //valid credential
        $validator=Validator::make($credentials,[
            'email'=>'required|email',
            'password'=>'required|string|min:6|max:50'
        ]);
        //send failed response if request not valid
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        //request is validated
        try {
            if (! $token=JWTAuth::attempt($credentials)) {
                return response()->json([
                    'success'=>false,
                    'message'=>'Login credentials are invalid'
                ]);
            }
        } catch (JWTException $e) {
            return $credentials;
            return response()->json([
                'success'=>false,
                'message'=>'Could not create token.'
            ],500);
        }
        //token created, return with success response and jwt token
        return response()->json([
            'success'=>true,
            'token'=>$token,
        ]);
    }
    public function logout(Request $request)
    {
        //valid credential 
        $validator=Validator::make($request->only('token'),[
            'token'=>'required'
        ]);
        //send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        //request is validated, do logout
        try {
            JWTAuth::invalidate($request->token);
            return response()->json([
                'success'=>true,
                'message'=>'User has been logged out'
            ]);

        } catch (JWTException $exception) {
            return response()->json([
                'success'=>false,
                'message'=>'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
 
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }
}
