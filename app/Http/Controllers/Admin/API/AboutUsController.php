<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\About;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AboutUsController extends Controller
{

  public function AboutUs(): JsonResponse
    {
        $data= About::first();
        if($data){
           $response = [
            'status' => 200,
            'message' => 'About fetched successfully',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No About Found',
            'data' => []
        ];  
        }
                return response()->json($response, 200);

         
    }
}
