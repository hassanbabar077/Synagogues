<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerSubCategory extends Model
{
    use HasFactory;
    
     function prayercategory()
    {
        return $this->belongsTo(PrayerCategory::class,'prayer_category_id','id');
    }
     function prayertime()
    {
        return $this->hasMany(PrayerTime::class,'prayer_sub_categories_id','id');
    }
    
    

    

   
}
