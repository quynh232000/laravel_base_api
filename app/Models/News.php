<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = "news";
    protected $fillable = [
        'user_id',
        'slug',
        'title',
        'content',
        'thumbnail',
        'likes',
        'is_show',
        'category',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
