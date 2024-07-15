<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SessionVideo;
use Illuminate\Http\JsonResponse;

class VideosController extends Controller
{
    public function SessionVideos(): JsonResponse
    {
        $data= SessionVideo::get();
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
