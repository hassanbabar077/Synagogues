<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Synagogue;
use App\Models\PrayerCategory;

class PrayerTime extends Model
{
    use HasFactory;
    protected $fillable = [
        'time',
        'synagogue_id',
        'prayer_category_id',
        'location',
        'head_person',
        'phone',
        'image',
        'links',
        'discription',
        'youtube_url',
    ];
    public function synagogue()
    {
        return $this->belongsTo(Synagogue::class);
    }

    public function prayercategory()
    {
        return $this->belongsTo(PrayerCategory::class,'prayer_category_id','id');
    }
       public function prayersubcategory()
    {
        return $this->belongsTo(PrayerSubCategory::class, 'prayer_sub_categories_id', 'id');
    }
    public function prayertimes()
    {
        return $this->hasManyThrough(
            PrayerTime::class,
            PrayerSubCategory::class,
            'prayer_category_id', // Foreign key on PrayerSubCategory table
            'prayer_sub_categories_id', // Foreign key on PrayerTime table
            'id', // Local key on PrayerCategory table
            'id' // Local key on PrayerSubCategory table
        );
    }


 



   
}
