<?php

namespace App\Http\Controllers;

use App\Models\Admin\Message;
use App\Models\Admin\MessageThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MessageController extends Controller
{
    protected $user, $default_language, $static_data;
    public function __construct(){
        $this->user = Auth::user();
        $this->default_language = default_language();
        $this->static_data = static_home();
    }

    public function index(){
        if(get_setting('enable_messages', 'user')){
            $static_data = $this->static_data;
            $default_language = $this->default_language;
            $threads = MessageThread::where('user_id', $this->user->id)->orderBy('closed', 'desc')->orderBy('created_at', 'desc')->paginate(10);
            return view('home.message.index', compact('static_data', 'default_language','threads'));
        }else{
            return redirect()->back();   
        }
    }

    public function thread($id){
        $thread = MessageThread::findOrFail($id);
        if($thread->closed && $thread->user_id != $this->user->id && get_setting('enable_messages', 'user')){
            return redirect()->back();
        }else{
            $static_data = $this->static_data;
            $default_language = $this->default_language;
            $messages = Message::where('thread_id', $id)->orderBy('created_at', 'desc')->get();
            return view('home.message.message', compact('static_data', 'default_language', 'thread', 'messages'));
        }
    }

    public function reply(Request $request, $id){
        $thread = MessageThread::findOrFail($id);
        $thread->status = 1;

        if($thread->owner && $thread->user){
            // Create the Message
            $data['thread_id'] = $thread->id;
            $data['user'] = 1;
            $data['message'] = $request->message;
            Message::create($data);

            // Mailing
            $static_data = static_home();
            $mail_data['message_received'] = $static_data['strings']['message_received'];
            $mail_data['message_received'] = $static_data['strings']['message_received'];
            $mail_data['str_from'] = $static_data['strings']['from'];
            $mail_data['from'] = $thread->user ? $thread->user->username : '';
            $mail_data['email'] = $thread->owner ? $thread->owner->email : '';
            $mail_data['first_name'] = $thread->owner ? $thread->owner->info->first_name : '';
            $mail_data['message_login_to_reply'] = $static_data['strings']['message_login_to_reply'];
            $mail_data['regards'] = $static_data['strings']['regards'];
            $mail_data['site_name'] = $static_data['site_settings']['site_name'];
            $mail_data['admin_email'] = $static_data['site_settings']['contact_email'];

            // Create the mail and send it
            Mail::send('emails.message', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                $m->from($mail_data['admin_email'], $mail_data['site_name']);
                $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['message_received'] .' - '. $mail_data['site_name']);
            });

            $thread->touch();
            $thread->save();
            Session::flash('success_message_sent', true);
            return redirect()->route('message');
        }else{
            return redirect()->route('message');
        }
    }

    public function post(Request $request){
        $data['status'] = 1;
        $data['owner_id'] = $request->owner_id;
        $data['user_id'] = $request->user_id;
        $data['closed'] = 0;

        $thread = MessageThread::where('closed', 0)->where('user_id', $data['user_id'])->where('owner_id', $data['owner_id'])->first();
        if(!$thread){ // If there is no open thread, create one
            $thread = MessageThread::create($data);
        }

        if($thread->owner && $thread->user){
            // Create the Message
            $data['thread_id'] = $thread->id;
            $data['user'] = 1;
            $data['message'] = $request->message;
            Message::create($data);

            // Mailing
            $static_data = $this->static_data;
            $mail_data['message_received'] = $static_data['strings']['message_received'];
            $mail_data['message_received'] = $static_data['strings']['message_received'];
            $mail_data['str_from'] = $static_data['strings']['from'];
            $mail_data['from'] = $thread->user ? $thread->user->username : '';
            $mail_data['email'] = $thread->owner ? $thread->owner->email : '';
            $mail_data['first_name'] = $thread->owner ? $thread->owner->info->first_name : '';
            $mail_data['message_login_to_reply'] = $static_data['strings']['message_login_to_reply'];
            $mail_data['regards'] = $static_data['strings']['regards'];
            $mail_data['site_name'] = $static_data['site_settings']['site_name'];
            $mail_data['admin_email'] = $static_data['site_settings']['contact_email'];

            // Create the mail and send it
            Mail::send('emails.message', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                $m->from($mail_data['admin_email'], $mail_data['site_name']);
                $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['message_received'] .' - '. $mail_data['site_name']);
            });

            $thread->touch();
            $thread->save();
            Session::flash('success_message_sent', true);
            return redirect()->route('message');
        }else{
            return redirect()->route('message');
        }
    }
}

