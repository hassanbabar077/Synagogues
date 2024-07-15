<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
     function show(){
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::get()->sortDesc();
        return view('admin.pages.dashboard.city' , compact('cities'));

    }
        function store(Request $request){
            abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

         $validator = Validator::make($request->all(), [
            'name' =>'required',
            'country' =>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
         $city = new City();
         $city->name = $request->name;
         $city->country = $request->country;
         $city->save();
         if($city){
            return redirect()->route('cities')->with('success', 'City Created Successfully.');

         }else{
            return redirect()->route('cities')->with('error', 'Failed To Create City.Please retry..');

         }

    }
     function UpdateCity(Request $request, $id){
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city = City::where('id',$id)->update([
            'name' => $request->name,
            'country' => $request->country,
        ]);
        if($city){
            return redirect()->route('cities')->with('success', 'City Updated Successfully.');
        }
        return redirect()->route('cities')->with('success', 'Failed To Update. Please Retry');
    }

     function delete($id){
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city = City::find($id)->delete();
        if($city){
            return redirect()->route('cities')->with('success', 'City Deleted Successfully.');

         }else{
            return redirect()->route('cities')->with('error', 'Failed to delete City.Please retry..');

         }
    }
}
