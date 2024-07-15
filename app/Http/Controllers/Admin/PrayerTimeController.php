<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\PrayerTime;
use App\Models\Synagogue;
use App\Models\PrayerCategory;
use App\Models\PrayerSubCategory;
use App\Models\Manager;

use Gate;
use Symfony\Component\HttpFoundation\Response;

class PrayerTimeController extends Controller
{
    function show(){
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
       $prayerTimes = PrayerTime::with('prayercategory','synagogue')->get();
        return view('admin.pages.dashboard.prayer-time' ,compact('prayerTimes'));
    }

    function create(){
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        $PrayerSubCategory=PrayerSubCategory::all();
        $prayerCategories = PrayerCategory::all();
        return view('admin.pages.dashboard.create-prayer-time' , compact('synagogues', 'prayerCategories','PrayerSubCategory'));
    }

    function store(Request $request){
      
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $this->validate($request, [
            'time' =>'required',
            'synagogue_id' =>'required',
            'prayer_sub_categories_id' =>'required',
            
        ]);
        $prayerTime = new PrayerTime();
        $prayerTime->time = $request->time;
          
        $prayerTime->synagogue_id = $request->synagogue_id;
        $prayerTime->prayer_sub_categories_id=$request->prayer_sub_categories_id;
        $prayerTime->location = $request->location;
        $prayerTime->discription = $request->discription;
        // $prayerTime->prayer_category_id = 1;
        // $prayerTime->head_person = $request->head_person;
        // $prayerTime->phone = $request->phone;
        // $prayerTime->links = $request->links;
        // $prayerTime->youtube_url = $request->youtube_url;
        if ($request->hasFile('image')) {
            if ($prayerTime->image) {
                $oldImage = public_path('admin/assets/images/PrayerTime/' . basename($prayerTime->image));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->image->extension();
            $path = $request->file('image')->move(public_path('admin/assets/images/PrayerTime'), $fileName);
            $prayerTime->image = url('admin/assets/images/PrayerTime/' . $fileName);
        }
     
        $prayerTime->save();

        if($prayerTime){
            return redirect()->route('prayer-time')->with('success', 'Prayer Time Created Successfully.');

         }else{
            return redirect()->route('prayer-time')->with('error', 'Failed To Create Prayer Time.Please Retry..');
         }

    }

    function edit($id){
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $synagogues = Synagogue::all();
         $PrayerSubCategory=PrayerSubCategory::all();
        $prayerCategories = PrayerCategory::all();
        $prayerTime = PrayerTime::find($id);
        return view('admin.pages.dashboard.update-prayer-time', compact('prayerTime','synagogues', 'prayerCategories' , 'PrayerSubCategory'));
    }

    function update(Request $request, $id){
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $prayerTime = PrayerTime::find($id);
        $prayerTime->time = $request->time;
        $prayerTime->synagogue_id = $request->synagogue_id;
        // $prayerTime->prayer_category_id = $request->prayer_category_id;
          $prayerTime->prayer_sub_categories_id=$request->prayer_sub_categories_id;
        // $prayerTime->head_person = $request->head_person;
        // $prayerTime->phone = $request->phone;
        $prayerTime->location = $request->location;
        // $prayerTime->links = $request->links;
        $prayerTime->discription = $request->discription;
        // $prayerTime->youtube_url = $request->youtube_url;
        if ($request->hasFile('image')) {
            if ($prayerTime->image) {
                $oldImage = public_path('admin/assets/images/PrayerTime/' . basename($prayerTime->image));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->image->extension();
            $path = $request->file('image')->move(public_path('admin/assets/images/PrayerTime'), $fileName);
            $prayerTime->image = url('admin/assets/images/PrayerTime/' . $fileName);
        }
        $prayerTime->update();
        if($prayerTime){
            return redirect()->route('prayer-time')->with('success', 'Prayer Time Updated Successfully.');

         }else{
            return redirect()->route('prayer-time')->with('error', 'Failed To Update Prayer Time.Please Retry..');
         }
    }
    function delete($id){
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $prayerTime = PrayerTime::find($id);
        if ($prayerTime->image) {
            $oldImage = public_path('admin/assets/images/PrayerTime/' . basename($prayerTime->image));
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $prayerTime->delete();
        if($prayerTime){
            return redirect()->route('prayer-time')->with('success', 'Prayer Time Deleted Successfully.');

         }else{
            return redirect()->route('prayer-time')->with('error', 'Failed To Delete Prayer Time.Please Retry..');
         }
    }
}
