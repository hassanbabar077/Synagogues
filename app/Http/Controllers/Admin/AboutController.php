<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class AboutController extends Controller
{
    public function show()
    {
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $app_about = About::all();

        return view('admin.pages.dashboard.about', compact('app_about'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make($request->all(), [
           'title' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $about = new About();
        $about->title = $request->title;
        $about->content = $request->content;
        $about->subtitle = $request->subtitle;
        $about->link = $request->link;
        $about->description = $request->description;

        $about->save();
        if ($about) {
            return redirect()->route('about')->with('success', 'About Created Successfully');

        } else {
            return redirect()->route('about')->with('error', 'About Create Failed');

        }

    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $about = About::find($id);
        $about->title = $request->title;
        $about->content = $request->content;
        $about->subtitle = $request->subtitle;
        $about->link = $request->link;
        $about->description = $request->description;
        $about->save();
        if ($about) {
            return redirect()->route('about')->with('success', 'About Updated Successfully');

        } else {
            return redirect()->route('about')->with('error', 'About Update Failed');

        }
    }

    public function delete($id)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $about = About::find($id);
        $about->delete();
        if ($about) {
            return redirect()->route('about')->with('success', 'About Deleted Successfully');

        } else {
            return redirect()->route('about')->with('error', 'About Delete Failed');
        }
    }
}
