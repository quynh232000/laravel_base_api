<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\News;
use App\Models\ProcessTour;
use App\Models\Product;
use App\Models\Province;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Hash;
use Str;

class AdminController extends Controller
{

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
    public function hidden($id)
    {
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


    public function create(Request $request)
    {
        $provinces = Province::all();
        $countries = Country::all();
        return view('createtour', compact('provinces', 'countries'));
    }

    public function create_(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'thumnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'required',
            'type' => 'required',
            'category' => 'required',
            'price' => 'required',
            'price_child' => 'required',
            'price_baby' => 'required',
            'percent_sale' => 'required',
            'additional_fee' => 'required',
            "province_start_id" => 'required',
            "province_end_id" => 'required',
            'number_of_day' => 'required',
            'tour_pakage' => 'required',
            'quantity' => 'required',
            'date_start' => 'required',
            'time_start' => 'required',
            'transportation' => 'required'
        ]);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors())->withInput()->with('errorMess', 'Vui lòng nhập đầy đủ thông tin!');

        }

        try {
            $images = [];
            if ($request->hasFile('images')) {
                if (count($request->images) > 4) {
                    return redirect()->back()->withErrors($validate->errors())->withInput()->with('errorMess', 'Images must not exceed 4 items!');
                }
                foreach ($request->file('images') as $image) {
                    // $images[] = $image->store('tour', 'public');
                    $images[] = Cloudinary::upload($image->getRealPath())->getSecurePath();

                }
            }
            $thumnail = "";
            if ($request->hasFile('thumnail')) {
                // $thumnail = $request->file('thumnail')->store('tour', 'public');
                $thumnail = Cloudinary::upload($request->file('thumnail')->getRealPath())->getSecurePath();

            }

            $tour = Product::create([
                'uuid' => Str::uuid(),
                'slug' => $request->title,
                'title' => $request->title,
                'thumnail' => $thumnail,
                'country_id' => $request->country_id ?? 232,
                'images' => json_encode($images),
                'type' => $request->type,
                'category' => $request->category,
                'price' => $request->price,
                'price_child' => $request->price_child,
                'price_baby' => $request->price_baby,
                'percent_sale' => $request->percent_sale,
                'additional_fee' => $request->additional_fee,
                "province_start_id" => $request->province_start_id,
                "province_end_id" => $request->province_end_id,
                'number_of_day' => $request->number_of_day,
                'tour_pakage' => $request->tour_pakage,
                'quantity' => $request->quantity,
                'date_start' => $request->date_start,
                'time_start' => $request->time_start,
                'transportation' => $request->transportation,
                'tourguide_id' => auth('web')->user()->id,
            ]);
            $tour->slug = Str::slug($request->title) . '_' . $tour->id;
            $tour->save();
            // create process tour

            $processTours = [];
            if ($request->has(['date', 'title_process', 'content'])) {
                if (count($request->date) != count($request->title_process) || count($request->date) != count($request->content ?? [])) {

                    return redirect()->back()->withInput()->with('errorMess', 'Missing parameters of precess detail!');
                }
                foreach ($request->date as $key => $value) {
                    $processTours[] = ProcessTour::create([
                        'product_id' => $tour->id,
                        'date' => $value,
                        'title' => $request->title_process[$key],
                        'content' => $request->content[$key]
                    ]);
                }
            }
            $tour['process_tour'] = $processTours;
            return redirect()->back()->withInput()->with('successMess', 'Tour created successfully');
        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errorMess', 'An error occurred while creating tour:' . $e->getMessage());

        }
    }

    public function create_news(Request $request)
    {
        return view('createnews');
    }
    public function create_news_(Request $request)
    {
        try {
            $validate = Validator::make($request->all(), [
                'title' => 'required|string',
                'thumbnail' => 'required|image',
                'category' => 'required',
                'content' => 'required'
            ]);
            if ($validate->fails()) {
                return redirect()->back()->withErrors($validate->errors())->withInput()->with('errorMess', 'Vui lòng nhập đầy đủ thông tin!');

            }
            $thumbnail = "";
            if ($request->hasFile('thumbnail')) {
                $thumbnail = Cloudinary::upload($request->file('thumbnail')->getRealPath())->getSecurePath();

                // $thumbnail = $request->file('thumbnail')->store('news', 'public');
            }
            $news = News::create([
                'user_id' => auth('web')->id(),
                'slug' => $request->title,
                'title' => $request->title,
                'content' => $request->content,
                'thumbnail' => $thumbnail,
                'likes' => 0,
                'category' => $request->category,
            ]);
            $news->slug = Str::slug($request->title) . '_' . $news->id;
            $news->save();
            return redirect()->back()->withInput()->with('successMess', 'News created successfully');


        } catch (Exception $e) {
            return redirect()->back()->withInput()->with('errorMess', 'An error occurred while creating news:' . $e->getMessage());

        }
    }
}
