<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
}
