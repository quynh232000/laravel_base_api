<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable  = [
        'title',
        'thumnail',
        'images',
        'uuid',
        'is_show',
        'slug',
        'type',
        'category',
        'price',
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
}
