<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\AppVersion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class AppVersionController extends Controller
{
    
     public function CurruntAppVersion(): JsonResponse
    {
        $data= AppVersion::first();
        if($data){
           $response = [
            'status' => 200,
            'message' => 'Version fetched successfully',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No Version Found',
            'data' => []
        ];  
        }
     return response()->json($response, 200);

         
    }
}
