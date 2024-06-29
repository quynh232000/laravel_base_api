<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Str;
use Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);



        if ($validator->fails()) {
            return Response::json(false, 'Missing parameters', $validator->errors());
        }

        $user = User::create([
            'uuid' => Str::uuid(),
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = auth('api')->login($user);
        return Response::json(true, 'Register successful', $user, $this->respondWithToken($token));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails()) {
            return Response::json(false, 'Missing parameters', $validator->errors());
        }
        $user = User::where('email', $request->email)->get();
        if (count($user) == 0) {
            return Response::json(false, 'Email không tồn tại trên hệ thống!', $validator->errors());
        }
        if (!$token = auth('api')->attempt($validator->validated())) {
            return Response::json(false, 'Mật khẩu không đúng!', $validator->errors());
        }

       

        return Response::json(true, 'Login successfully!', auth('api')->user(), $this->respondWithToken($token));
    }


    public function me()
    {
        return Response::json(true, 'Success', response()->json(auth()->user()));
    }


    public function logout()
    {
        auth()->logout();

        return Response::json(true, 'Successfully logged out');
    }


    public function refresh()
    {
        $token = $this->respondWithToken(auth()->refresh());
        return Response::json(true, 'Refreshing token', auth()->user(), $this->respondWithToken(auth()->refresh()));
    }


    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ];
    }
}