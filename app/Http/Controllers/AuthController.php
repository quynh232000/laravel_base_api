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
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{

       /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="register",
     *      tags={"Users"},
     *      summary="Register a user",
     *      description="Returns new user",
     *     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="full_name",
     *                     description="Your full name",
     *                     type="string",
     *                      example="Nguyen van a"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     description="Your email address",
     *                     type="string",
     *                      example="test@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Your password",
     *                     type="string"
     *                 ),
     *                @OA\Property(
     *                     property="password_confirmation",
     *                     description="confirm password",
     *                     type="string"
     *                 ),
     *             )
     *         )
     *     ),
     *      @OA\Response(response="405", description="Invalid input"),
     * )
     */
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


    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      operationId="login",
     *      tags={"Users"},
     *      summary="Login",
     *      description="Returns user",
     *     
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     * 
     *                     property="email",
     *                     description="Your email address",
     *                     type="string",
     *                    example="test@gmail.com"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     description="Your password",
     *                     type="string",
     *                     example="123456"
     *                 ),
     *             )
     *         )
     *     ),
     *      @OA\Response(response="405", description="Invalid input"),
     * )
     */
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




    /**
     * @OA\Get(
    
     * 
     *      path="/api/me",
     *      operationId="getme",
     *      tags={"Users"},
     *      summary="Get User Information",
     *      description="Returns user information",
     *      @OA\Header(
     *         header="Authorization",
     *         description="Api key header",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *  security={{
     *         "bearer": {}
     *     }},
     *     @OA\Response(
     *         response=400,
     *         description="Invalid ID supplied"
     *     ),
     * 
     *     
     * )
     */
    public function me()
    {

        $user = auth()->user();
        if ($user == null)
            return Response::json(false, "Unauthorized");
        return Response::json(true, 'Success', auth()->user());
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