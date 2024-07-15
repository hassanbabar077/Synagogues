<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Synagogue;
use App\Models\City;



class SynagoguesController extends Controller
{
     public function SynagoguesList(): JsonResponse
    {
        $data= City::with('synagogues')->get();
        if($data){
           $response = [
            'status' => 200,
            'message' => 'Synagogues fetched successfully',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No synagogues Found',
            'data' => []
        ];  
        }
                return response()->json($response, 200);

         
    }
}
