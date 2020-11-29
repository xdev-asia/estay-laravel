<?php

namespace App\Http\Controllers;

use App\Models\Admin\Booking;
use App\Models\Admin\Feature;
use App\Models\Admin\Property;
use App\Models\Admin\PropertyDate;
use App\Models\Admin\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class PropertyController extends Controller
{
    protected $default_language;
    protected $static_data;

    public function __construct()
    {
        $this->default_language = default_language();
        $this->static_data = static_home();
    }

    public function index($alias)
    {
        $static_data = $this->static_data;
        $default_language = $this->default_language;
        $property = Property::with(['images', 'contentload' => function ($query) use ($default_language) {
            $query->where('language_id', $default_language->id);
        }])->where('alias', $alias)->first();
        $features = Feature::all();

        if ($property) {
            // Get booked dates for calendar
            $dates = PropertyDate::where('property_id', $property->id)->pluck('dates')->toArray();
            if ($dates || !count($dates)) {
                $dates = [];
            }
            $bookings = Booking::where('property_id', $property->id)->get();
            foreach ($bookings as $booking) {
                $date = generateDateRangeB(Carbon::createFromFormat('Y-m-d', $booking->start_date), Carbon::createFromFormat('Y-m-d', $booking->end_date));
                if ($date) {
                    $dates[] = $date;
                }
            }
            if (isset($dates[0])) {
                $dates = array_reduce($dates, 'array_merge', []);
            }
            $reviews = Review::where('property_id', $property->id)->where('status', 1)->take(3)->get();
            $similar = Property::with(['images', 'contentload' => function ($query) use ($default_language) {
                $query->where('language_id', $default_language->id);
            }])->where('id', '!=', $property->id)->where(function ($query) use ($property) {
                $query->where('category_id', $property->category->id)->orWhere('location_id', $property->prop_location->id);
            })->inRandomOrder()->take(3)->get();

            $mainProperty = $property;

            return view('home.property', compact('mainProperty', 'property', 'static_data', 'features', 'default_language', 'similar', 'reviews', 'dates'));
        } else {
            abort(404);
        }
    }

    public function book(Request $request)
    {
        $static_data = $this->static_data;
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'first_name' => 'required',
                'start_date' => 'required',
                'email' => 'email|required',
                'phone' => 'required',
                'end_date' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($static_data['strings']['something_happened'], 400);
            } else {
                $currency_code = get_setting('currency_code', 'site');
                $currency = currency()->getCurrency($request->currency_code);
                $currency = $currency['symbol'] ? $currency['symbol'] : '';

                $data = $request->all();
                $data['guest_number'] = $data['guests'];
                $data['completed'] = get_setting('autoapprove_booking', 'property');
                $data['start_date'] = Carbon::createFromFormat('d/m/Y', $data['start_date'])->format('Y-m-d');
                if ($currency_code != $request->currency_code) {
                    $data['total'] = currency($data['total'], Session::get('currency'), $currency_code, false);
                }
                $data['end_date'] = Carbon::createFromFormat('d/m/Y', $data['end_date'])->format('Y-m-d');
                $data['user_id'] = ($static_data['user']) ? $static_data['user']->id : 0;
                $data['user_data']['first_name'] = $data['first_name'];
                $data['user_data']['email'] = $data['email'];
                $data['user_data']['phone'] = $data['phone'];

                // Generate helper data
                $mail_data = $data;
                $property = Property::where('id', $request->property_id)->first();
                $data['owner_id'] = $property->user_id;
                $data['status'] = 0;
                $mail_data['property'] = isset($property->contentload->name) ? $property->contentload->name : '';
                $mail_data['currency'] = $currency;
                $mail_data['subject'] = $static_data['strings']['booking'] . ' - ' . $static_data['site_settings']['site_name'];
                $mail_data['admin_email'] = $static_data['site_settings']['contact_email'];
                $mail_data['site_name'] = $static_data['site_settings']['site_name'];
                $mail_data['from'] = $static_data['strings']['from'];
                $mail_data['to'] = $static_data['strings']['to'];
                $mail_data['thank'] = $static_data['strings']['thank_you_for_book_mail'];
                $mail_data['regards'] = $static_data['strings']['regards'];
                $mail_data['str_property'] = $static_data['strings']['property'];
                $mail_data['str_guest_number'] = $static_data['strings']['guest_number'];
                $mail_data['str_total'] = $static_data['strings']['total'];
                $mail_data['mail_after_text_book'] = $static_data['strings']['mail_after_text_book'];

                // Create the mail and send it
                Mail::send('emails.booked', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                    $m->from($mail_data['admin_email'], $mail_data['site_name']);
                    $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['subject']);
                });
                $data['owner_id'] = $property->user ? $property->user->id : 0;
                $booking = Booking::create($data);

                if ($booking->owner) {
                    $owner = $booking->owner;
                    $mail_data['email'] = $owner->email;
                    $mail_data['first_name'] = $owner->info->first_name;
                    $mail_data['thank'] = $static_data['strings']['you_have_received_new_booking'];

                    // Create the mail and send it
                    Mail::send('emails.booked', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                        $m->from($mail_data['admin_email'], $mail_data['site_name']);
                        $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['subject']);
                    });
                }

                return response()->json($static_data['strings']['thank_you_for_book'], 200);
            }
        } else {
            return response()->json($static_data['strings']['something_happened'], 400);
        }
    }
}
