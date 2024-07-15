<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayTime extends Model
{
    use HasFactory;
    protected $fillable =[
        'icon',
        'time',
        'event_type'
    ];
}
