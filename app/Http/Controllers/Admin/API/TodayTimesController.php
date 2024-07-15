<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\TodayTime;
use App\Models\PrayerTime;
use Illuminate\Support\Facades\Validator;



class TodayTimesController extends Controller
{
   
    
    public function TodayTimes(): JsonResponse
    {
        $data= TodayTime::get();
        if($data){
           $response = [
            'status' => 200,
            'message' => 'Today Time fetched successfully',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No Today Time Found',
            'data' => []
        ];  
        }
                return response()->json($response, 200);

         
    }
  public function SynagoguePrayerTimes(Request $request)
{
    $validator = Validator::make($request->all(), [
        'synagogue_id' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 400,
            'message' => $validator->errors(),
        ], 400);
    }

    $data = PrayerTime::where('synagogue_id', $request->synagogue_id)->get()->makeHidden(['prayer_category_id','prayer_sub_categories_id','created_at','updated_at']);

    if ($data->isEmpty()) {
        return response()->json([
            'status' => 200,
            'message' => 'No Prayer Time found for the given Synagogue ID.',
            'data' => []
        ], 200);
    }

    return response()->json([
        'status' => 200,
        'message' => 'Prayer Times fetched successfully.',
        'data' => $data
    ], 200);
}

    
    
    
    
    
}
