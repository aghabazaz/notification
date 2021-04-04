<?php

namespace App\Http\Controllers;

use App\Services\Notification\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Notification\Constants\EmailTypes;
use App\Jobs\SendEmail;
use App\Jobs\SendSms;

class NotificationsController extends Controller
{
    /**
     * show send email form
     */
    public function email(){
        $users=USER::all();
        $emailTypes=EmailTypes::toString();
            return view('notifications.send-email',compact('users','emailTypes'));
    }
    public function sendEmail(Request $request){
        $request->validate([
           'user'=>'integer | exists:users,id',
            'email_type'=>'integer'
        ]);
      //  dd($request->all());
        try{
            $notification=resolve(Notification::class);

            $mailable=EmailTypes::toMail($request->email_type);
           // dd($mailable);
          //  SendEmail
            SendEmail::dispatch(User::find($request->user),new $mailable);
            return redirect()->back()->with('success',__('notification.email_send_successfully'));
        }catch (\Throwable $th){
            return redirect()->back()->with('failed',__('notification.email_has_problem'));
        }

    }
    public function sms(Request $request){
        $users=User::all();
        return view('notifications.send-sms',compact('users'));
    }
    public function sendSms(Request $request,Notification $notification ){
        $request->validate([
           'user'=>'integer | exists:users,id',
           'text'=>'string | max:256'
        ]);
        try{
            SendSms::dispatch(User::find($request->user),$request->text);
            return redirect()->back()->with('success',__('notification.sms_send_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with('failed',__('notification.sms_has_problem'));
        }
    }
}
