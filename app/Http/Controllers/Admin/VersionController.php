<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppVersion;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class VersionController extends Controller
{
    function show(){
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $versions = AppVersion::all();
        return view('admin.pages.dashboard.app-version' , compact('versions'));
    }


    function store(Request $request){
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validator = Validator::make($request->all(), [
            'version' =>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $version = new AppVersion();
        $version->version = $request->version;
        $version->description = $request->description;
        $version->save();
        if($version){
            return redirect()->route('version')->with('success', 'Version Created Successfully');

          }else{
            return redirect()->route('version')->with('error', 'Version Create Failed');

          }
    }
    function update(Request $request , $id){
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $version = AppVersion::find($id);
        $version->version = $request->version;
        $version->description = $request->description;
        $version->update();
        if($version){
            return redirect()->route('version')->with('success', 'Version Updated Successfully');

          }else{
            return redirect()->route('version')->with('error', 'Version Update Failed');

          }
    }
    function delete($id){
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $version = AppVersion::find($id);
        $version->delete();
        if($version){
            return redirect()->route('version')->with('success', 'Version Deleted Successfully');

          }else{
            return redirect()->route('version')->with('error', 'Version Delete Failed');

          }
    }
}
