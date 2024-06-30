<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Hash;


class AdminController extends Controller
{
    /**
     * @OA\Get(
     *      path="/tour/list",
     *      operationId="getlisttour",
     *      tags={"GetListTour"},
     *      summary="Get list of Tours",
     *      description="Returns a list of tours",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *      ),
     *      security={
     *          {"api_key": {}}
     *      }
     * )
     */
    public function list()
    {
        $tours = Product::latest()->paginate(10);
        return view('list', compact('tours'));
    }
    public function login_(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput()->with('errorMess', 'Vui lòng nhập đầy đủ thông tin!');
        }
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();


        if ($user) {
            $credentials = $request->only('email', 'password');
            if (auth('web')->attempt($credentials)) {

                return redirect()->intended('/');
            } else {
                return redirect()->back()->withInput()->with('errorMess', 'Mật khẩu không chính xác!');
            }

        } else {
            return redirect()->back()->withInput()->with('errorMess', 'Email đăng nhập không đúng!');

        }


    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return redirect()->route('list')->with('success', 'Xóa tour thành công');
        } else {
            return redirect()->route('list')->with('error', 'Xóa tour thất bại');
        }
    }
    public function hidden($id) {
        $product = Product::find($id);
        if ($product) {
            $product->is_show = 0;
            $product->save();
            return redirect()->route('list')->with('success', 'Ẩn tour thành công');
        } else {
            return redirect()->route('list')->with('error', 'Ẩn tour thất bại');
        }

    }
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->is_show = 1;
            $product->save();
            return redirect()->route('list')->with('success', 'Hiển thị tour thành công');
        } else {
            return redirect()->route('list')->with('error', 'Hiển thị tour thất bại');
        }
    }
}
