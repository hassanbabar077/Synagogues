<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SessionDetail;
use App\Models\LessonCategory;
use App\Models\Synagogue;
use Illuminate\Http\JsonResponse;

class ToraLessonsController extends Controller
{
    
        
        public function torahLessons(): JsonResponse
    {
        $data=LessonCategory::with(['sessionDetails.synagogue.city'])
        ->get();
        if($data){
           $response = [
            'status' => 200,
            'message' => 'Videos fetched successfully',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No videos Found',
            'data' => []
        ];  
        }
                return response()->json($response, 200);

         
    }
}
