<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextEditor extends Model
{
    use HasFactory;

    protected $fillable =[
        'tab_main_tab',
        'tab_torah_lessons',
        'tab_synagogues',
        'tab_today_times',
        'tab_contact_us',
        'info_about_us',
        'info_share'
    ];
}
