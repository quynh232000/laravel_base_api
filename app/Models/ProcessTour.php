<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessTour extends Model
{
    use HasFactory;
    protected $table = "process_tours";
    protected $fillable = [
        'product_id',
        'date',
        'title',
        'content'
    ];
}
