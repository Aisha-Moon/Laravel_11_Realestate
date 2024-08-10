<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\AddUserMail;

class AdminController extends Controller
{
    public function adminDashboard(){
        return view('admin.index');
    }
    public function adminLogout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin/login');
    }
    public function adminLogin(){
        return view('admin.admin_login');
    }
    public function adminProfile(Request $request){
        $data['getRecord']=User::find(Auth::user()->id);
        return view('admin.admin_profile',$data);
    }
    public function adminProfileUpdate(Request $request){
        // dd($request->all());

        $user=$request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required|unique:users,email,'.Auth::user()->id,
            'phone'=>'required',
            'password'=>'nullable',
            'photo'=>'nullable',
            'address'=>'required',
            'about'=>'required',
            'website'=>'required',
        ]);
        $user=User::find(Auth::user()->id);
        $user->name=trim($request->name);
        $user->username=trim($request->username);
        $user->email=trim($request->email);
        $user->phone=trim($request->phone);
        // $user->password=trim($request->password);
        // $user->photo=trim($request->photo);
        if(!empty($request->password)){
            $user->password=Hash::make($request->password);
        }
        if(!empty($request->file('photo'))){
            $file=$request->file('photo');
            $str=Str::random(30);
            $filename=$str.'.'.$file->getClientOriginalExtension();
            $file->move('uploads/admin_images/',$filename);
            $user->photo=$filename;
        }
        $user->address=trim($request->address);
        $user->about=trim($request->about);
        $user->website=trim($request->website);

        $user->save();
        return redirect('admin/profile')->with('success', 'Profile Updated Successfully');



    }

    public function admin_users(Request $request){
        $data['getRecord']=User::getRecord($request);
        return view('admin.users.list',$data);
    }
    public function admin_users_view($id){
        $data['getRecord']=User::find($id);
        return view('admin.users.view',$data);

    }

    //add user
    public function admin_users_create(Request $request){
        return view('admin.users.add');

    }
    public function admin_users_store(Request $request){

        $user=$request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'status'=>'required',
            'role'=>'required',
        ]);

        $user=new User();
        $user->name=trim($request->name);
        $user->username=trim($request->username);
        $user->email=trim($request->email);
        $user->phone=trim($request->phone);
        $user->role=trim($request->role);
        $user->status=trim($request->status);
        $user->remember_token=Str::random(50);
        $user->save();

        Mail::to($user->email)->send(new AddUserMail($user)); //RegisterMail

        return redirect('admin/users')->with('success', 'User Added Successfully');
    }

    public function set_new_password($token){

        $data['token']=$token;
        return view('auth.reset_pass',$data);
    }
    public function set_new_password_post($token, ResetPassword $request)
{
    // Find the user by the token
    $user = User::where('remember_token', $token)->first();

    // Check if the user exists
    if (!$user) {
        abort(404);
    }

    // Update the user's password and status
    $user->password = Hash::make($request->password);
    $user->status = 'active';
    $user->save();

    // Redirect to login with success message
    return redirect('admin/login')->with('success', 'Password has been reset successfully');
}

public function admin_users_edit($id){
    $data['user'] = User::find($id);
    return view('admin.users.edit',$data);
}
public function admin_users_update($id,Request $request){

    $user=User::find($id);
    $user->name=trim($request->name);
    $user->username=trim($request->username);
    $user->email=trim($request->email);
    $user->phone=trim($request->phone);
    $user->role=trim($request->role);
    $user->status=trim($request->status);
    $user->save();
    return redirect('admin/users')->with('success', 'User Updated Successfully');
}

public function admin_users_delete($id,Request $request){
    $softDelete=User::find($id);
    $softDelete->is_delete=1;
    $softDelete->save();

    return redirect('admin/users')->with('success', 'User Deleted Successfully');
}

}
