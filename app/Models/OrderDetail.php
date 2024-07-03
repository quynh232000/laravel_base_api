<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = "order_details";
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'quantity_child',
        'quantity_baby',
        'additional_fee',
        'price',
        'price_child',
        'price_baby',
    ];
    public function order(){
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}
