<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Synagogue;
use App\Models\LessonCategory;


class SessionDetail extends Model
{
    use HasFactory;
     protected $fillable =[
        'session_name' ,
        'synagogue_id',
        'category_id' ,
        'session_time',
        'days_of_session',
        'session_image',
        'instructor',
        'youtube_url',
        'address',
        'phone',
        'discription',
    ];
    public function synagogue()
{
    return $this->belongsTo(Synagogue::class);
}

public function category()
{
    return $this->belongsTo(LessonCategory::class);
}
}
