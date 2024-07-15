<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\City;
use App\Models\Synagogue;
use App\Models\Manager;
use Gate;
use Illuminate\Support\Facades\Hash;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
class ManagersController extends Controller
{
     public function show(){
         $synagogues = Synagogue::get();
        $managers = User::role('manager')->with('manager.synagogue')->get();
        
    // return $synagogues=User::with('manager','manager.synagogue')->get();
             
         return view('admin.pages.dashboard.synagogues-manager',compact('managers', 'synagogues'));
     }
     public function store(Request $request)
{
    // Validate the incoming request
    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:4',
        'synagogue' => 'required',
    ]);

    // Handle validation failures
    if ($validator->fails()) {
        return redirect()->back()
                         ->withErrors($validator)
                         ->withInput();
    }

    // Create a new User instance and save it to the database
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    $user->assignRole('manager');

    if ($user) {
        $manager = new Manager();
        $manager->user_id = $user->id;
        $manager->synagogue_id = $request->synagogue;
        $manager->save();

        if ($manager) {
            return redirect()->route('synagogues.managers')->with('success', 'Synagogue Manager Created Successfully.');
        }
    }

    // Handle failures in creating the user or manager
    return redirect()->back()->withErrors(['error' => 'Unable To Create User. Please Try Again.']);
}
 function delete($id){
   $delete=  User::where('id',$id)->delete();
      if ($delete) {
            return redirect()->route('synagogues.managers')->with('success', 'Manager Deleted Successfully.');
        }else{
                return redirect()->back()->withErrors(['error' => 'Unable To Delete User. Please Try Again.']);

        }
 }
 

}
