<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrayerCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'icon'
    ];
    // function prayerTimes(){
    //     return $this->hasMany(PrayerTime::class);
    //  }
      public function prayerTimes()
    {
        return $this->hasManyThrough(PrayerTime::class, PrayerSubCategory::class, 'prayer_category_id', 'prayer_sub_categories_id');
    }
      
      public function prayersubcategories()
    {
        return $this->hasMany(PrayerSubCategory::class, 'prayer_category_id', 'id');
    }
     
    
     
}
