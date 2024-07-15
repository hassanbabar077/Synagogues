<?php

namespace App\Http\Controllers\Admin\API;

use App\Models\AppContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ContactUsController extends Controller
{
    
  
  public function AppContactUs(): JsonResponse
    {
        $data= AppContactUs::get();
        if($data){
           $response = [
            'status' => 200,
            'message' => 'Contacts details fetched successfully',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No Contact detail Found',
            'data' => []
        ];  
        }
                return response()->json($response, 200);

         
    }
    
}
