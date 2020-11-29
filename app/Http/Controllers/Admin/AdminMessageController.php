<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Message;
use App\Models\Admin\MessageThread;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminMessageController extends Controller
{
    public function index(){
        $threads = MessageThread::orderBy('closed', 'desc')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.message.index', compact('threads'));
    }

    public function thread($id){
        $thread = MessageThread::findOrFail($id);
        if($thread->closed){
            return redirect()->back();
        }else{
            $messages = Message::where('thread_id', $id)->orderBy('created_at', 'desc')->get();
            return view('admin.message.message', compact('thread', 'messages'));
        }
    }

    public function close(Request $request, $id){
        if($request->ajax()) {
            $thread = MessageThread::findOrFail($id);
            
            // Delete the Thread
            $thread->closed = 1;
            $thread->touch();
            $thread->save();
            return response()->json(get_string('success_close'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function delete(Request $request, $id){
        if($request->ajax()) {
            $thread = MessageThread::findOrFail($id);
            
            // Get the Messages
            $messages = $thread->messages;
            foreach($messages as $message){
                $message->delete();
            }

            // Delete the Thread
            $thread->delete();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function reply(Request $request, $id){
        $thread = MessageThread::findOrFail($id);
        $thread->status = 2;

        if($thread->owner && $thread->user){
            // Create the Message
            $data['thread_id'] = $thread->id;
            $data['user'] = 0;
            $data['message'] = $request->message;
            Message::create($data);

            // Mailing
            $static_data = static_home();
            $mail_data['message_received'] = $static_data['strings']['message_received'];
            $mail_data['message_received'] = $static_data['strings']['message_received'];
            $mail_data['str_from'] = $static_data['strings']['from'];
            $mail_data['from'] = $thread->owner ? $thread->owner->username : '';
            $mail_data['email'] = $thread->user ? $thread->user->email : '';
            $mail_data['first_name'] = $thread->user ? $thread->user->info->first_name : '';
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
            return redirect()->route('admin_message');
        }else{
            return redirect()->route('admin_message');
        }
    }

}

