<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\UserRequest;
use App\Models\Admin\Owner;
use App\Models\UserInfo;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;


class AdminUserRequestController extends Controller
{
    public function index(){
        $requests = UserRequest::orderBy('created_at','desc')->paginate(10);
        return view('admin.user.request', compact('requests'));
    }

    // Complete request
    public function complete(Request $request, $id){
        if($request->ajax()) {
            $user_request = UserRequest::findOrFail($id);
            $user = User::findOrFail($user_request->user_id);
            $user_info = UserInfo::where('user_id', $user_request->user_id)->first();

            // Updating user
            $user->role_id = 2;
            $data = $user_info->toArray();
            $data['user_id'] = $user->id;
            $owner = Owner::create($data);
            $user_info->delete();
            $user->touch();
            $user->save();

            $user_request->completed = 1;


            $static_data = static_home();
            $mail_data = [
                'first_name'        => $owner->first_name,
                'last_name'         => $owner->last_name,
                'username'          => $user->username,
                'str_username'      => $static_data['strings']['username'],
                'str_email'         => $static_data['strings']['email'],
                'activate_account'  => $static_data['strings']['upgrade_completed'],
                'email'             => $user->email,
                'message'           => $static_data['strings']['upgrade_completed_email'],
                'site_name'         => $static_data['site_settings']['site_name'],
                'admin_email'       => $static_data['site_settings']['contact_email'],
                'regards'           => $static_data['strings']['regards']
            ];

            // Create the mail and send it
            Mail::send('emails.upgrade', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                $m->from($mail_data['admin_email'], $mail_data['site_name']);
                $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['activate_account'].' - '.$mail_data['site_name']);
            });

            $user_request->save();
            return response()->json(get_string('completed_request'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Complete request
    public function dismiss(Request $request, $id){
        if($request->ajax()) {
            $user_request = UserRequest::findOrFail($id);
            $user_request->completed = 1;
            $user_request->save();
            return response()->json(get_string('dismissed_request'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Delete request
    public function delete(Request $request, $id){
        if($request->ajax()) {
            $user_request = UserRequest::findOrFail($id);
            $user_request->delete();
            return response()->json(get_string('delete_request_completed'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
