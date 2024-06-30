<?php

namespace App\Http\Controllers;

use App\Models\ProcessTour;
use App\Models\Product;
use App\Models\Response;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Str;

class TourController extends Controller
{

    public function create(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'thumnail' => 'required|image',
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
            return Response::json(false, 'Missing parameters', $validate->errors());
        }


        $images = [];
        if ($request->hasFile('images')) {
            if (count($request->images) > 4) {
                return Response::json(false, 'Images must not exceed 4 items');
            }
            foreach ($request->images as $image) {
                $images[] = $image->store('public/tour', 'public');
                // $images[] = Cloudinary::upload($image->getRealPath())->getSecurePath();
            }
        }
        $thumnail = "";
        if ($request->hasFile('thumnail')) {
            $thumnail = $request->file('thumnail')->store('public/tour', 'public');
            // $thumnail = Cloudinary::upload($request->thumnail->getRealPath())->getSecurePath();
        }

        $tour = Product::create([
            'uuid' => Str::uuid(),
            'slug' => $request->title,
            'title' => $request->title,
            'thumnail' => $thumnail,
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
            'tourguide_id' => auth('api')->user()->id,
        ]);
        $tour->slug = Str::slug($request->title) . '_' . $tour->id;
        $tour->save();
        // create process tour

        $processTours = [];
        if ($request->has(['date', 'title_process', 'content'])) {
            if (count($request->date) != count($request->title_process) || count($request->date) != count($request->content)) {
                return Response::json(false, 'Missing parameters of precess detail');
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

        return Response::json(true, 'Tour created successfully', $tour);
    }
}
