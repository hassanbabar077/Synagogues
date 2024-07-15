<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\Synagogue;
use App\Models\PrayerTime;
use Illuminate\Http\Request;
use App\Models\PrayerCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class PrayersController extends Controller
{
 
    public function Prayers(): JsonResponse
    {
        // $data= PrayerCategory::with('prayer_sub_category','prayerTimes','prayerTimes.synagogue.city')->get();
        $data = PrayerCategory::with('prayersubcategories.prayertime', 'prayersubcategories.prayertime.synagogue')->get();

        if($data){
           $response = [
            'status' => 200,
            'message' => 'Prayer Categories fetched successfully',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No Prayer Categories Found',
            'data' => []
        ];  
        }
                return response()->json($response, 200);

         
    }
}
