<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Booking;
use App\Models\Admin\Property;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class AdminBookingController extends Controller
{
    public function index(){
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        $bookings = Booking::orderBy('created_at','desc')->paginate(10);
        return view('admin.booking', compact('bookings', 'currency'));
    }

    public function userInfo(Request $request, $id){
        if($request->ajax()) {
            $booking = Booking::findOrFail($id);
            return response()->json($booking->user_data, 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function delete(Request $request, $id){
        if($request->ajax()) {
            $booking = Booking::findOrFail($id);
            $booking->delete();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function activate(Request $request, $id){
        if($request->ajax()) {
            $booking = Booking::findOrFail($id);
            $booking->completed = 1;

            // Mailing
            $static_data = static_home();
            $property = Property::where('id', $booking->property_id)->first();
            $mail_data['property'] = isset($property->contentload->name) ? $property->contentload->name : '';
            $mail_data['start_date'] = $booking->start_date;
            $mail_data['end_date'] = $booking->end_date;
            $mail_data['total'] = $booking->total;
            $mail_data['guest_number'] = $booking->guest_number;
            $mail_data['first_name'] = $booking->user_data['first_name'];
            $mail_data['email'] = $booking->user_data['email'];
            $mail_data['currency'] = $static_data['site_settings']['currency'];
            $mail_data['subject'] = $static_data['strings']['booking_accepted'] . ' - ' . $static_data['site_settings']['site_name'];
            $mail_data['admin_email']   = $static_data['site_settings']['contact_email'];
            $mail_data['site_name'] = $static_data['site_settings']['site_name'];
            $mail_data['from'] = $static_data['strings']['from'];
            $mail_data['to'] = $static_data['strings']['to'];
            $mail_data['thank'] = $static_data['strings']['booking_is_confirmed'];
            $mail_data['regards'] = $static_data['strings']['regards'];
            $mail_data['str_property'] = $static_data['strings']['property'];
            $mail_data['str_guest_number'] = $static_data['strings']['guest_number'];
            $mail_data['str_total'] = $static_data['strings']['total'];
            $mail_data['mail_after_text_book'] = $static_data['strings']['mail_after_text_book'];

            // Create the mail and send it
            Mail::send('emails.success_booked', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                $m->from($mail_data['admin_email'], $mail_data['site_name'])
                ->to($mail_data['email'], $mail_data['first_name'])
                ->subject($mail_data['subject']);
            });

            $booking->save();
            return response()->json(get_string('successfully_accepted'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function reject(Request $request, $id){
        if($request->ajax()) {
            $booking = Booking::findOrFail($id);
            $booking->completed = 1;

            // Mailing
            $static_data = static_home();
            $property = Property::where('id', $booking->property_id)->first();
            $mail_data['property'] = isset($property->contentload->name) ? $property->contentload->name : '';
            $mail_data['first_name'] = $booking->user_data['first_name'];
            $mail_data['email'] = $booking->user_data['email'];
            $mail_data['subject'] = $static_data['strings']['booking_rejected'] . ' - ' . $static_data['site_settings']['site_name'];
            $mail_data['admin_email']   = $static_data['site_settings']['contact_email'];
            $mail_data['site_name'] = $static_data['site_settings']['site_name'];
            $mail_data['thank'] = $static_data['strings']['booking_is_rejected'];
            $mail_data['reason'] = $request->reason;
            $mail_data['str_reason'] = $static_data['strings']['reason'];
            $mail_data['regards'] = $static_data['strings']['regards'];
            $mail_data['str_property'] = $static_data['strings']['property'];
            $mail_data['mail_after_text_book'] = $static_data['strings']['mail_after_text_book'];

            // Create the mail and send it
            Mail::send('emails.reject_booked', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                $m->from($mail_data['admin_email'], $mail_data['site_name']);
                $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['subject']);
            });

            $booking->save();
            return response()->json(get_string('successfully_rejected'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

}

