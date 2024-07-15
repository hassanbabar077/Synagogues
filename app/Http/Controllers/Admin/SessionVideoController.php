<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\SessionVideo;

class SessionVideoController extends Controller
{
    public function show()
    {
        abort_if(Gate::denies('permission_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $session_videos = SessionVideo::all();
        return view('admin.pages.dashboard.session-videos' , compact('session_videos'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video_url' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $session_video = new SessionVideo();
        $session_video->title = $request->title;
        $session_video->video_url = $request->video_url;
        $session_video->description = $request->description;
        $session_video->save();
        if ($session_video) {
            return redirect()->route('session-videos')->with('success', 'Video Created Successfully.');

        } else {
            return redirect()->route('session-videos')->with('error', 'Failed To Create Video.Please Retry..');
        }

    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('permission_update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'video_url' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $session_video = SessionVideo::find($id);
        $session_video->title = $request->title;
        $session_video->video_url = $request->video_url;
        $session_video->description = $request->description;
        $session_video->update();
        if ($session_video) {
            return redirect()->route('session-videos')->with('success', 'Video Updated Successfully.');

        } else {
            return redirect()->route('session-videos')->with('error', 'Failed To Update Video.Please Retry..');
        }
    }
    function delete($id) {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $session_video = SessionVideo::find($id);
        $session_video->delete();
        if ($session_video) {
            return redirect()->route('session-videos')->with('success', 'Video Deleted Successfully.');

        } else {
            return redirect()->route('session-videos')->with('error', 'Failed To Delete Video.Please Retry..');
        }
    }
}
