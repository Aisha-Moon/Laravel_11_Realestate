<?php

namespace App\Http\Controllers;

use App\Models\ComposeEmail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComposeEmailMail;

class EmailController extends Controller
{
    public function email_compose(){
        $data['getEmail'] = User::whereIn('role', ['agent', 'user'])->get();
        return view('admin.email.compose', $data);
    }

    public function email_compose_post(Request $request){


        // Create a new email record
        $email = new ComposeEmail();
        $email->user_id = $request->user_id;
        $email->cc_email = trim($request->cc_email);
        $email->subject = trim($request->subject);
        $email->description = trim($request->description);
        $email->save();

        //email start

        $getUserEmail=User::where('id',$request->user_id)->first();
        Mail::to($getUserEmail->email)->cc($request->cc_email)->send(new ComposeEmailMail($email));
       // email end
        return redirect('admin/email/compose')->with('success','Email Send Successfully');
    }

    public function sent_email(Request $request){
       $data['getEmail']=ComposeEmail::get();
       return view('admin.email.sent_email',$data);
    }

    public function admin_delete_sent_email(Request $request){
        if(!empty($request->id)){
            $option=explode(',',$request->id);
            foreach($option as $id){
                if(!empty($id)){
                    $getRecord=ComposeEmail::find($id);
                    $getRecord->delete();
                }
            }
        }
        return redirect()->back()->with('success','Record deleted successfully');
    }

 }

