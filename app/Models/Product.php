<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'title',
        'thumnail',
        'images',
        'uuid',
        'is_show',
        'slug',
        'type',
        'category',
        'price',
        'country_id',
        'price_child',
        'price_baby',
        'percent_sale',
        'additional_fee',
        "province_start_id",
        "province_end_id",
        'number_of_day',
        'tour_pakage',
        'quantity',
        'date_start',
        'time_start',
        'status',
        'tourguide_id',
        'transportation',

    ];
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    public function province_start()
    {
        return $this->belongsTo(Province::class, 'province_start_id');
    }
    public function province_end()
    {
        return $this->belongsTo(Province::class, 'province_end_id');
    }
    public function tourguide()
    {
        return $this->belongsTo(User::class, 'tourguide_id');
    }
    public function process_tour()
    {
        return $this->hasMany(ProcessTour::class);
    }
    public function like_count()
    {
        return Like::where('product_id', $this->id)->count() ?? 0;
    }
    public function is_like($user_id)
    {
        if($user_id){
            return Like::where(['product_id'=> $this->id,'user_id'=> $user_id])->exists();

        }else{
            return false;
        }
    }
}
