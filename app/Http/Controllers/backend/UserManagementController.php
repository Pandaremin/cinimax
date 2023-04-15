<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserManagementController extends Controller
{
    
    public function profile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user-management.profile',compact('user'));
    }

    public function passwordUpdate(Request $request){
        $validatedData = $request->validate([
           'oldpassword' => 'required',
           'password' => 'required|confirmed',
        ]);

       $hashedPassword = Auth::user()->password;
       if (Hash::check($request->oldpassword,$hashedPassword)) {
           $user = User::find(Auth::id());
           $user->password = Hash::make($request->password);
           $user->save();
           Auth::logout();
           return redirect()->route('login');
       }else{
           return redirect()->back();
       }
    }

    public function userIndex()
    {
        $data = User::all();
        $countuser = User::count();
        $premiumuser = User::where('role','=','premium_user')->count();
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user-management.user-view',compact(['data','user','countuser','premiumuser']));
    }

    public function contentManagerAdd()
    {
        $data = User::all();
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.user-management.content-manager-add',compact(['data','user']));
    }

    public function contentManagerStore(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ]);
        $useradd = new User();
    	$useradd->name = $request->name;
    	$useradd->email = $request->email;
    	$useradd->password = Hash::make($request->password);
    	$useradd->role = $request->role;
        $useradd->save();
    	// $code = rand(0000,9999);
        
        return view('backend.user-management.user-view',compact('user'));
    }

    
    public function userEdit($id)
    {
        $authid = Auth::user()->id;
        $user = User::find($authid);
        $data=User::find($id);
        return view('backend.user-management.user-edit',compact(['data','user']));
    }

    
    public function userUpdate(Request $request, $id)
    {
        $authid = Auth::user()->id;
        $user = User::find($authid);
        $data=User::find($id);
        $data->role=$request->role;
        $data->save();
        return redirect()->route('admin.users.view');
    }

    public function userDestroy($id)
    {
        $data=User::find($id)->delete();
        return redirect()->route('admin.users.view');
    }
}
