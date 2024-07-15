<?php

namespace App\Http\Controllers\Admin\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TextEditor;
use Illuminate\Http\JsonResponse;


class AppSettingsController extends Controller
{

     public function AppSettings(): JsonResponse
    {
        $data= TextEditor::first();
        if($data){
           $response = [
            'status' => 200,
            'message' => 'App Settings fetched successfully.',
            'data' => $data
        ]; 
        }else{
           $response = [
            'status' => 200,
            'message' => 'No App Settings Found.',
            'data' => []
        ];  
        }
                return response()->json($response, 200);

         
    }
}
