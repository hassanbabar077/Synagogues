<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AppContactUs;
use Gate;
use Illuminate\Support\Facades\Validator;

use Symfony\Component\HttpFoundation\Response;

class ContactUsController extends Controller
{
    function show(){
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $contacts = AppContactUs::all();
        return view('admin.pages.dashboard.contact-us', compact('contacts'));
    }

    function store(Request $request){
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make($request->all(), [
            'phone_number' =>'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $contact = new AppContactUs();
        $contact->phone_number = $request->phone_number;
        $contact->email = $request->email;
        $contact->discription = $request->discription;
        $contact->save();
        if($contact){
            return redirect()->route('contact-us')->with('success', 'Contact Created Successfully');

          }else{
            return redirect()->route('contact-us')->with('error', 'Contact Create Failed');

          }
    }
    function update(Request $request, $id){
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact = AppContactUs::find($id);
        $contact->phone_number = $request->phone_number;
        $contact->email = $request->email;
        $contact->discription = $request->discription;
        $contact->update();
        if($contact){
            return redirect()->route('contact-us')->with('success', 'Contact Updated Successfully');

          }else{
            return redirect()->route('contact-us')->with('error', 'Contact Update Failed');

          }
    }
    function delete($id){
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contact = AppContactUs::find($id);
        $contact->delete();
        if($contact){
            return redirect()->route('contact-us')->with('success', 'Contact Deleted Successfully');

          }else{
            return redirect()->route('contact-us')->with('error', 'Contact Delete Failed');

          }
    }
}
