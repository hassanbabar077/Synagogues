<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\SessionDetail;
use App\Models\Synagogue;
use App\Models\Manager;
use App\Models\LessonCategory;
use Spatie\Permission\Models\Role;
use Gate;

use Symfony\Component\HttpFoundation\Response;

class SessionDetailController extends Controller
{
   function show(){
    abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $session_details = SessionDetail::orderBy('id', 'desc')->get();

    return view('admin.pages.dashboard.session-detail' , compact('session_details'));
   }

   function create(){
   
     $user=auth()->user();
    if ($user->hasRole('administrator')) {
           $synagogues = Synagogue::get();
           $categories = LessonCategory::get();
           return view('admin.pages.dashboard.create-session-detail', compact('synagogues', 'categories'));
        } elseif ($user->hasRole('manager')) {
            $manager = $user->manager;
            if ($manager) {
                $synagogues = Synagogue::where('id', $manager->synagogue_id)->get();
                $categories = LessonCategory::get();
                return view('admin.pages.dashboard.create-session-detail', compact('synagogues', 'categories'));
            }
        }else {
                $synagogues = collect(); 
            }

     
     
   }

   function store(Request $request){
    // abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $request->validate([
        'session_name' =>'required',
        'synagogue_id' =>'required',
        'category_id' =>'required',
        'session_time' =>'required',
        'instructor' =>'required',
        'days'=>'required'
    ]);

    $session_detail = new SessionDetail();
    $session_detail->session_name = $request->session_name;
    $session_detail->synagogue_id = $request->synagogue_id;
    
    $session_detail->category_id = $request->category_id;
    if ($request->hasFile('session_image')) {
        if ($session_detail->session_image) {
            $oldImage = public_path('admin/assets/images/SessionDetail/' . basename($session_detail->session_image));
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $fileName = time().'.'.$request->session_image->extension();
        $path = $request->file('session_image')->move(public_path('admin/assets/images/SessionDetail'), $fileName);
        $session_detail->session_image = url('admin/assets/images/SessionDetail/' . $fileName);
    }

    $session_detail->session_time = $request->session_time;
     if ($request->has('days')) {
        $session_detail->days_of_session = implode(',', $request->days);
    }
    $session_detail->instructor = $request->instructor;
       $session_detail->phone = $request->phone_number;

    $session_detail->youtube_url = $request->youtube_url;
     if (!$request->address) {
         $address_synagogue=Synagogue::where('id',$request->synagogue_id)->value('address');
        $session_detail->address =$address_synagogue;
    }else{
         $session_detail->address = $request->address;
    }
   
    $session_detail->discription = $request->discription;
    $session_detail->save();
    if($session_detail){
        return redirect()->route('session-details')->with('success', 'Session Detail Created Successfully.');

     }else{
        return redirect()->route('session-details')->with('error', 'Failed To Create Session Detail.Please Retry..');
     }
   }

   function edit($id){
    abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $user=auth()->user();
    if ($user->hasRole('administrator')) {
           $synagogues = Synagogue::get();
        } elseif ($user->hasRole('manager')) {
            $manager = $user->manager;
            if ($manager) {
                $synagogues = Synagogue::where('id', $manager->synagogue_id)->get();
            }
        }else {
                $synagogues = collect(); 
            }
    $categories = LessonCategory::get();
    $session_details = SessionDetail::find($id);
    $selectedDays = explode(',', $session_details->days_of_session);
    
      abort_if(!$session_details, Response::HTTP_NOT_FOUND, '404 Not Found');
    return view('admin.pages.dashboard.update-session-detail', compact('session_details' , 'categories' , 'synagogues','selectedDays'));
   }
   function update(Request $request, $id){
    abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $request->validate([
        'session_name' =>'required',
        'synagogue_id' =>'required',
        'category_id' =>'required',
        'session_time' =>'required',
        'instructor' =>'required',
        'days'=>'required'
    ]);
    $session_detail = SessionDetail::find($id);
    $session_detail->session_name = $request->session_name;
    $session_detail->synagogue_id = $request->synagogue_id;
    $session_detail->category_id = $request->category_id;
    if ($request->hasFile('session_image')) {
        if ($session_detail->session_image) {
            $oldImage = public_path('admin/assets/images/SessionDetail/' . basename($session_detail->session_image));
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $fileName = time().'.'.$request->session_image->extension();
        $path = $request->file('session_image')->move(public_path('admin/assets/images/SessionDetail'), $fileName);
        $session_detail->session_image = url('admin/assets/images/SessionDetail/' . $fileName);
    }
    $session_detail->session_time = $request->session_time;
    // $session_detail->days_of_session = $request->days_of_session; 
    if ($request->has('days')) {
        $session_detail->days_of_session = implode(',', $request->days);
    }
    $session_detail->instructor = $request->instructor;
    $session_detail->phone = $request->phone_number;
    $session_detail->youtube_url = $request->youtube_url;
      if (!$request->address) {
         $address_synagogue=Synagogue::where('id',$request->synagogue_id)->value('address');
        $session_detail->address =$address_synagogue;
    }else{
         $session_detail->address = $request->address;
    }
    $session_detail->discription = $request->discription;
    $session_detail->update();
    if($session_detail){
        return redirect()->route('session-details')->with('success', 'Session Detail Updated Successfully.');

     }else{
        return redirect()->route('session-details')->with('error', 'Failed To Update Session Detail.Please Retry..');
     }

   }
   function delete($id){
    abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    $session_detail = SessionDetail::find($id);
    if ($session_detail->session_image) {
        $oldImage = public_path('admin/assets/images/SessionDetail/' . basename($session_detail->session_image));
        if (File::exists($oldImage)) {
            File::delete($oldImage);
        }
    }
    $session_detail->delete();
    if($session_detail){
        return redirect()->route('session-details')->with('success', 'Session Detail Deleted Successfully.');

     }else{
        return redirect()->route('session-details')->with('error', 'Failed To Delete Session Detail.Please Retry..');
     }
   }

}
