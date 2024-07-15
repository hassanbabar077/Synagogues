<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TodayTime;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class TodayTimeController extends Controller
{
    public function show()
    {

        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $todaytime = TodayTime::all();

        return view('admin.pages.dashboard.todaytime', compact('todaytime'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $validator = Validator::make($request->all(), [
            'icon' => 'required',
            'time' => 'required',
            'event_type' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $todaytime = new TodayTime();
        if ($request->hasFile('icon')) {
            if ($todaytime->icon) {
                $oldImage = public_path('admin/assets/images/TodayTime/'.basename($todaytime->icon));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->icon->extension();
            $path = $request->file('icon')->move(public_path('admin/assets/images/TodayTime'), $fileName);
            $todaytime->icon = url('admin/assets/images/TodayTime/'.$fileName);
        }
        $todaytime->time = $request->time;
        $todaytime->event_type = $request->event_type;
        $todaytime->save();
        if ($todaytime) {
            return redirect()->route('todaytime')->with('success', 'Today Time Created Successfully.');

        } else {
            return redirect()->route('todaytime')->with('error', 'Failed To Create Today Time.Please Retry..');
        }
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $todaytime = TodayTime::find($id);
        if ($request->hasFile('icon')) {
            if ($todaytime->icon) {
                $oldImage = public_path('admin/assets/images/TodayTime/'.basename($todaytime->icon));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->icon->extension();
            $path = $request->file('icon')->move(public_path('admin/assets/images/TodayTime'), $fileName);
            $todaytime->icon = url('admin/assets/images/TodayTime/'.$fileName);
        }
        // $todaytime->time = $request->time;
        // $todaytime->event_type = $request->event_type;
        $todaytime->update();
        if ($todaytime) {
            return redirect()->route('todaytime')->with('success', 'Today Time Updated Successfully.');

        } else {
            return redirect()->route('todaytime')->with('error', 'Failed To Update Today Time.Please Retry..');
        }

    }

    public function delete($id)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $todaytime = TodayTime::find($id);
        if ($todaytime->icon) {
            $oldImage = public_path('admin/assets/images/TodayTime/'.basename($todaytime->icon));
            if (File::exists($oldImage)) {
                File::delete($oldImage);
            }
        }
        $todaytime->delete();
        if ($todaytime) {
            return redirect()->route('todaytime')->with('success', 'Today Time Deleted Successfully.');

        } else {
            return redirect()->route('todaytime')->with('error', 'Failed To Delete Today Time.Please Retry..');
        }
    }
}
