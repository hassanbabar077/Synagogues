<?php

namespace App\Http\Controllers\Auth;

use Gate;
use App\Models\User;
use App\Models\Synagogue;
use App\Models\SessionDetail;
use App\Models\SessionVideo;
use App\Models\AppVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    function  Home(){
       $managers = User::whereHas('roles', function($query) {
        $query->where('name', 'manager');
    })->count();
     $synagogues = Synagogue::count();
     $lessons = SessionDetail::count();
     $videos = SessionVideo::count();
     $version = AppVersion::first();
      return view('admin.pages.dashboard.index',compact(['managers' ,'synagogues' , 'lessons' , 'videos' , 'version']));

     }
    function ProfileEdit(){

        return view('admin.pages.dashboard.account');
    }

    public function UpdateProfile(Request $request)
    {
        $user = Auth::user();

        if ($request->filled('username')) {
            $user->name = $request->username;
        }
        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture) {
                $oldImage = public_path('admin/assets/images/profile/' . basename($user->profile_picture));
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $fileName = time().'.'.$request->profile_picture->extension();
            $path = $request->file('profile_picture')->move(public_path('admin/assets/images/profile'), $fileName);
            $user->profile_picture = url('admin/assets/images/profile/' . $fileName);
        }
        if ($request->filled('username')) {
            $user->name = $request->username;
        }
        // $request->filled('email') ||
        if ( $request->filled('newPassword')) {
            if (!Hash::check($request->oldpassword, $user->getAuthPassword())) {
                return back()->withErrors(['error' => 'The provided Old password does not match your current password.']);
            }
            // if ($request->filled('email')) {
            //     $user->email = $request->email;
            // }

            if ($request->filled('newPassword')) {
                $user->password = Hash::make($request->newPassword);
            }
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    function AccountSettings(){
        abort_if(Gate::denies('permission_account_settings'), Response::HTTP_FORBIDDEN, '403 Forbidden');

       $roles= Role::with('users','permissions')->get();

        return view('admin.pages.dashboard.account-settings',compact('roles'));
    }
}
