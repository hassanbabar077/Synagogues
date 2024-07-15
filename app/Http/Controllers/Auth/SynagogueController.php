<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\Synagogue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SynagogueController extends Controller
{
    function show(){
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = Auth::user();
        if ($user->hasRole('administrator')) {
                    $synagogue = Synagogue::all()->sortDesc();
                } elseif ($user->hasRole('manager')) {
                    $manager = $user->manager;
                    if ($manager) {
                        $synagogue = Synagogue::where('id', $manager->synagogue_id)->get();
                    } else {
                        $synagogue = collect(); 
                    }
                } else {
                    abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
                }
        return view('admin.pages.dashboard.synagogue' , compact('synagogue'));
    }
    function create(){
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city=City::get();
        return view('admin.pages.dashboard.create-synagogue',compact('city'));
    }
    function store(Request $request ){
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validate = $request->validate([
            'name' =>'required',
            'city_id' =>'required',
            'address' =>'required',
            'logo' =>'required',
        ]);
        $synagogue = new Synagogue();
        $synagogue->name = $request->name;
        if ($request->hasFile('logo')) {
            if ($synagogue->logo) {
                $oldImage = public_path('admin/assets/images/synagogue/' . basename($synagogue->logo));
                if (File::exists($oldImage)) {
                    // File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->logo->extension();
            $path = $request->file('logo')->move(public_path('admin/assets/images/synagogue'), $fileName);
            $synagogue->logo = url('admin/assets/images/synagogue/' . $fileName);
        }
        $synagogue->address = $request->address;
        $synagogue->phone = $request->phone;
        $synagogue->contact_person = $request->contact_person;
        $synagogue->city_id = $request->city_id;
        $synagogue->email = $request->email;
        $synagogue->discription = $request->discription;
        $synagogue->save();
        if($synagogue){
            return redirect()->route('synagogues')->with('success', 'Synagogue Created Successfully.');

         }else{
            return redirect()->route('synagogues')->with('error', 'Failed to create Synagogue.Please retry..');

         }
    }
        function edit($id) {
            abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            
            $user = Auth::user();
           
             if ($user->hasRole('administrator')) {
                 $synagogue = Synagogue::find($id);
                   abort_if(!$synagogue, Response::HTTP_NOT_FOUND, '404 Not Found');
            $city = City::all();
            return view('admin.pages.dashboard.update-synagogue', compact('synagogue', 'city'));
             }elseif ($user->hasRole('manager')) {
                 
            $synagogue = Synagogue::find($id);
            abort_if(!$synagogue, Response::HTTP_NOT_FOUND, '404 Not Found');
            $user = Auth::user();
                    $userHasAccess = \DB::table('managers')
                                ->where('user_id', $user->id)
                                ->where('synagogue_id', $id)
                                ->exists();
            abort_if(!$userHasAccess, Response::HTTP_FORBIDDEN, '403 Forbidden');
            $city = City::all();
            return view('admin.pages.dashboard.update-synagogue', compact('synagogue', 'city'));
             }
        }
    function update(Request $request, $id){
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
         $validate = $request->validate([
            'name' =>'required',
            'city_id' =>'required',
            'address'=>'required',
            
        ]);
        $synagogue = Synagogue::find($id);
        $synagogue->name = $request->name;
        if ($request->hasFile('logo')) {
            if ($synagogue->logo) {
                $oldImage = public_path('admin/assets/images/synagogue/' . basename($synagogue->logo));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->logo->extension();
            $path = $request->file('logo')->move(public_path('admin/assets/images/synagogue'), $fileName);
            $synagogue->logo = url('admin/assets/images/synagogue/' . $fileName);
        }
        $synagogue->address = $request->address;
        $synagogue->phone = $request->phone;
        $synagogue->contact_person = $request->contact_person;
        $synagogue->city_id = $request->city_id;
        $synagogue->email = $request->email;
        $synagogue->discription = $request->discription;
        $synagogue->update();
        if($synagogue){
            return redirect()->route('synagogues')->with('success', 'Synagogue Update successfully.');

         }else{
            return redirect()->route('synagogues')->with('error', 'Failed to Update Synagogue.Please retry..');

         }
    }

    function delete($id){
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $synagogue = Synagogue::find($id);
        $synagogue->delete();
        if($synagogue){
            return redirect()->route('synagogues')->with('success', 'Synagogue Deleted successfully.');

         }else{
            return redirect()->route('synagogues')->with('error', 'Failed to Delete Synagogue.Please retry..');

         }
    }

}
