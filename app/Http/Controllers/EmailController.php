<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    protected $static_data;

    public function __construct()
    {
        $this->static_data = static_home();
    }

    public function contact(Request $request)
    {
        $static_data = $this->static_data;

        if ($request->ajax()) {
            // Validate request
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
                'subject' => 'required',
                'body' => 'required'
            ], [
                'email.required' => $static_data['strings']['required_field'],
                'email.email' => $static_data['strings']['email_invalid'],
                'name.required' => $static_data['strings']['required_field'],
                'subject.required' => $static_data['strings']['required_field'],
                'body.required' => $static_data['strings']['required_field'],
            ]);
            if ($validation->fails()) {
                $errors = $validation->errors()->toArray();
                return response()->json(['status' => false, 'errors' => $errors]);
            } else {
                // Generate helper data
                $mail_data['email'] = $request->email;
                $mail_data['name'] = $request->name;
                $mail_data['subject'] = $request->subject;
                $mail_data['message'] = $request->body;
                $mail_data['contact_msg'] = $static_data['strings']['contact_email_msg'];
                $mail_data['site_name'] = $static_data['site_settings']['site_name'];
                $mail_data['from'] = $static_data['strings']['from'];
                $mail_data['to'] = $static_data['strings']['to'];
                $mail_data['admin_email'] = $static_data['site_settings']['contact_email'];
                $mail_data['site_name'] = $static_data['site_settings']['site_name'];
                $mail_data['mail_after_text'] = $static_data['strings']['mail_after_text'];
                $mail_data['regards'] = $static_data['strings']['regards'];
                $mail_data['reply'] = $static_data['strings']['reply'];
                // Create the mail and send it
                Mail::send('emails.contact', ['data' => $mail_data], function ($m) use ($mail_data) {
                    $m->from($mail_data['email'], $mail_data['name']);
                    $m->to($mail_data['admin_email'], $mail_data['site_name'])->subject($mail_data['subject']);
                });
                return response()->json(['status' => true, 'msg' => $static_data['strings']['email_sent_success']], 200);
            }
        } else {
            return response()->json($static_data['strings']['something_happened'], 400);
        }
    }
}
