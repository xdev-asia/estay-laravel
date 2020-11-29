<?php

namespace App\Http\Controllers;

use App\Models\Admin\Owner;
use App\Models\Admin\Payment;
use App\Models\Admin\Booking;
use App\Models\Admin\Property;
use Illuminate\Support\Facades\Mail;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;

class PaymentController extends Controller
{
    private $paypal_gw, $stripe_gw;
    public function __construct(){
        $this->paypal_gw = Omnipay::create('PayPal_Express');
        $this->paypal_gw->setUsername(get_setting('paypal_username', 'payment'));
        $this->paypal_gw->setPassword(get_setting('paypal_password', 'payment'));
        $this->paypal_gw->setSignature(get_setting('paypal_signature', 'payment'));
        $this->paypal_gw->setTestMode(get_setting('paypal_sandbox', 'payment'));
        $this->paypal_gw->setBrandName(get_setting('site_name', 'site'));
        $this->stripe_gw = Omnipay::create('Stripe');
        $this->stripe_gw->setApiKey(get_setting('stripe_secret_api_key', 'payment'));
    }

    public function index(Request $request){
        $this->validate($request,[
            'start_date'   => 'required',
            'end_date'     => 'required',
        ],[
            'start_date.required'      => get_string('fill_all_fields'),
            'end_date.required'      => get_string('fill_all_fields')
        ]);

        $default_language = default_language();
        $static_data = static_home();

        $gateways = [];
        if(get_setting('allow_paypal', 'payment')){
            $gateways[0] = 'PayPal';
        }
        if(get_setting('allow_stripe', 'payment')){
            $gateways[1] = 'Stripe';
        }

        // Get Dates
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $s_d = Carbon::createFromFormat('d/m/Y', $start_date);
        $e_d = Carbon::createFromFormat('d/m/Y', $end_date);

        // Calculate Total
        $property = Property::findOrFail($request->property_id);
        $days = ( $s_d->diffInDays($e_d) > 0 ) ? $s_d->diffInDays($e_d) : 1;  
        if($days){
            $price = 0;
            switch($days){
                case $days >= 30: $price = isset($property->prices['d_30']) ? $property->prices['d_30'] : $property->price_per_night; break;
                case $days >= 15: $price = isset($property->prices['d_15']) ? $property->prices['d_15'] : $property->price_per_night; break;
                case $days >= 5: $price = isset($property->prices['d_5']) ? $property->prices['d_5'] : $property->price_per_night; break;
                default: $price = $property->price_per_night; break;
            }
            // Calculate Total and Fees
            $total = $price * $days; 
            $fees = 0 ;
            if(isset($property->fees['city_fee'])){
                $fees += $property->fees['city_fee'];
            }
            if(isset($property->fees['cleaning_fee'])){
                $fees += $property->fees['cleaning_fee'];
            }

            // Convert To User's Currency
            $currency_code = get_setting('currency_code', 'site');
            $currency = currency()->getCurrency(Session::get('currency'));
            $currency = $currency['symbol'] ? $currency['symbol'] : '';
            if($currency_code != Session::get('currency')){
                $total = currency($total, $currency_code, Session::get('currency'), false);
                $fees = currency($fees, $currency_code, Session::get('currency'), false);
            }

            $grand_total = round(($total + $fees) * 100) / 100;

            // Guest Number and Property Name
            $owner_id = $property->user_id;
            $user_id = $static_data['user'] ? $static_data['user']->id : 0;
            $property_id = $property->id;
            $property = $property->content($default_language->id)->name;
            $guest_number = $request->guest_number;
            $email = $request->email;
            $phone = $request->phone;
            $first_name = $request->first_name;

            // Return View back
            return view('home.payment.index', compact('gateways', 'email', 'first_name', 'phone', 'owner_id', 'property_id', 'user_id', 'property', 'currency', 'static_data', 'guest_number', 'default_language', 'start_date', 'end_date', 'total', 'guest_number', 'fees', 'grand_total'));
        }else{
            return redirect()->back();
        }
    }


    public function payment(Request $request)
    {
        $default_language = default_language();
        $static_data = static_home();

        // Validate Request
        $this->validate($request,[
            'gateway'   => 'required',
            'start_date'   => 'required',
            'end_date'     => 'required',
        ],[
            'gateway.required'       => get_string('choose_payment_method'),
            'start_date.required'    => get_string('fill_all_fields'),
            'end_date.required'      => get_string('fill_all_fields')
        ]);
        $data['buy_points'] = get_string('pay_for_your_book') .' - '. $request->property_name;
        $data['description'] = get_string('booking') . ' - '. $request->property_name;

        // Get Dates
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $s_d = Carbon::createFromFormat('d/m/Y', $start_date);
        $e_d = Carbon::createFromFormat('d/m/Y', $end_date);

        // Calculate Total
        $property = Property::findOrFail($request->property_id);
        $days = ( $s_d->diffInDays($e_d) > 0 ) ? $s_d->diffInDays($e_d) : 1;  
        if($days){
            $price = 0;
            switch($days){
                case $days >= 30: $price = isset($property->prices['d_30']) ? $property->prices['d_30'] : $property->price_per_night; break;
                case $days >= 15: $price = isset($property->prices['d_15']) ? $property->prices['d_15'] : $property->price_per_night; break;
                case $days >= 5: $price = isset($property->prices['d_5']) ? $property->prices['d_5'] : $property->price_per_night; break;
                default: $price = $property->price_per_night; break;
            }
            // Calculate Total and Fees
            $total = $price * $days; 
            $fees = 0 ;
            if(isset($property->fees['city_fee'])){
                $fees += $property->fees['city_fee'];
            }
            if(isset($property->fees['cleaning_fee'])){
                $fees += $property->fees['cleaning_fee'];
            }

            // Convert To User's Currency
            $currency_code = get_setting('currency_code', 'site');
            $currency = currency()->getCurrency($request->currency_code);
            $currency = $currency['symbol'] ? $currency['symbol'] : '';
            if($currency_code != Session::get('currency')){
                $total = currency($total, $currency_code, Session::get('currency'), false);
                $fees = currency($fees, $currency_code, Session::get('currency'), false);
            }

            $grand_total = round(($total + $fees) * 100) / 100;

        }else{
            return abort(404);
        }
        
        if($request->gateway == 0){
            $params = [
                'cancelUrl' 	=> route('book_payment_cancel'),
                'returnUrl' 	=> route('book_payment_success'),
                'name'		    => $data['buy_points'],
                'description' 	=> $data['description'],
                'amount' 	    => $grand_total,
                'currency' 	    => Session::get('currency'),
                'user_id'       => $request->user_id,
                'owner_id'      => $request->owner_id,
                'property_id'   => $request->property_id,
                'guest_number'  => $request->guest_number,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'first_name'    => $request->first_name,
                'gateway'       => $request->gateway,
                'property_name' => $request->property_name,
            ];

            Session::put('params', $params);
            Session::save();

            $gateway = $this->paypal_gw;
            $response = $gateway->purchase($params)->send();
            if ($response->isSuccessful()) {
                return true;
            }elseif($response->isRedirect()) {
                $response->redirect();
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
                return view('home.payment.status', compact('static_data', 'default_language'));
            }
        }else if($request->gateway == 1){
            $params = [
                'name'          => $data['buy_points'],
                'description'   => $data['description'],
                'amount'        => $grand_total,
                'currency'      => Session::get('currency'),
                'user_id'       => $request->user_id,
                'owner_id'      => $request->owner_id,
                'property_id'   => $request->property_id,
                'guest_number'  => $request->guest_number,
                'start_date'    => $request->start_date,
                'end_date'      => $request->end_date,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'first_name'    => $request->first_name,
                'property_name' => $request->property_name,
                'gateway'       => $request->gateway,
                'token'         => $request->stripeToken,
            ];
            Session::put('params', $params);
            Session::save();
            $gateway = $this->stripe_gw;
            $response = $gateway->purchase($params)->send();
            if ($response->isSuccessful()) {
                $stripeResponse = $response->getData();
                if($stripeResponse['paid'] && $stripeResponse['status'] === 'succeeded'){
                    $user = Owner::where('user_id', $params['owner_id'])->first();
                    if($user){
                        $user->pending_balance += $params['amount'];
                        $user->save();
                    }

                    $params['total']  = $params['amount'];
                    $params['user_data']['first_name'] = $params['first_name'];
                    $params['user_data']['email'] = $params['email'];
                    $params['user_data']['phone'] = $params['phone'];
                    $params['start_date'] = Carbon::createFromFormat('d/m/Y', $params['start_date'])->format('Y-m-d');
                    $params['end_date'] = Carbon::createFromFormat('d/m/Y', $params['end_date'])->format('Y-m-d');
                    $booking = Booking::create($params);
                    $params['booking_id'] = $booking->id;
                    $params['transaction'] = isset($stripeResponse['id']) ? $stripeResponse['id'] : '';
                    $params['payment_method'] = 'Stripe';
                    $params['host_commission'] = get_setting('host_commission', 'payment');
                    Payment::create($params);

                    // Send Mail
                    $mail_data['guest_number'] = $params['guest_number'];
                    $mail_data['start_date'] = $params['start_date'];
                    $mail_data['total'] = $params['amount'];
                    $mail_data['end_date'] = $params['end_date'];
                    $mail_data['property'] = $params['property_name'];
                    $mail_data['currency'] = Session::get('currency');
                    $mail_data['subject'] = $static_data['strings']['booking'] . ' - ' . $static_data['site_settings']['site_name'];
                    $mail_data['first_name']   = $params['first_name'];
                    $mail_data['email']   = $params['email'];
                    $mail_data['admin_email']   = $static_data['site_settings']['contact_email'];
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

                    if($booking->owner){
                        $owner = $booking->owner;
                        $mail_data['email']  = $owner->email;
                        $mail_data['first_name']   = $owner->info->first_name;
                        $mail_data['thank'] = $static_data['strings']['you_have_received_new_booking'];


                         // Create the mail and send it
                        Mail::send('emails.booked', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                            $m->from($mail_data['admin_email'], $mail_data['site_name']);
                            $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['subject']);
                        }); 
                    }
                    
                    Session::forget('params');
                    return redirect()->route('book_payment_thank_you');
                }else{
                    Session::flash('payment_status', ['status' => false, 'msg' => $static_data['strings']['something_happened']]);
                    return view('home.payment.status', compact('static_data', 'default_language'));
                }
            }elseif($response->isRedirect()) {
                $response->redirect();
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
               return view('home.payment.status', compact('static_data', 'default_language'));
            }
        }
        return 0;
    }

    public function paymentSuccess()
    {
        $default_language = default_language();
        $static_data = static_home();

        $params = Session::get('params');
        if($params['gateway'] == 0){
            $gateway = $this->paypal_gw;
            $response = $gateway->completePurchase($params)->send();
            $paypalResponse = $response->getData();
            if(isset($paypalResponse['ACK']) && $paypalResponse['ACK'] === 'Success') {
               $user = Owner::where('user_id', $params['owner_id'])->first();
                if($user){
                    $user->pending_balance += $params['amount'];
                    $user->save();
                }
                $params['total']  = $params['amount'];
                $params['user_data']['first_name'] = $params['first_name'];
                $params['user_data']['email'] = $params['email'];
                $params['user_data']['phone'] = $params['phone'];
                $params['start_date'] = Carbon::createFromFormat('d/m/Y', $params['start_date'])->format('Y-m-d');
                $params['end_date'] = Carbon::createFromFormat('d/m/Y', $params['end_date'])->format('Y-m-d');
                $booking = Booking::create($params);
                $params['booking_id'] = $booking->id;
                $params['transaction'] = isset($paypalResponse['PAYMENTINFO_0_TRANSACTIONID']) ? $paypalResponse['PAYMENTINFO_0_TRANSACTIONID'] : '';
                $params['payment_method'] = 'PayPal';
                $params['host_commission'] = get_setting('host_commission', 'payment');
                Payment::create($params);

                // Send Mail
                $mail_data['guest_number'] = $params['guest_number'];
                $mail_data['start_date'] = $params['start_date'];
                $mail_data['total'] = $params['amount'];
                $mail_data['end_date'] = $params['end_date'];
                $mail_data['property'] = $params['property_name'];
                $mail_data['currency'] = Session::get('currency');
                $mail_data['subject'] = $static_data['strings']['booking'] . ' - ' . $static_data['site_settings']['site_name'];
                $mail_data['admin_email']   = $static_data['site_settings']['contact_email'];
                $mail_data['site_name'] = $static_data['site_settings']['site_name'];
                $mail_data['from'] = $static_data['strings']['from'];
                $mail_data['to'] = $static_data['strings']['to'];
                $mail_data['email']   = $params['email'];
                $mail_data['first_name']   = $params['first_name'];
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

                if($booking->owner){
                    $owner = $booking->owner;
                    $mail_data['email']  = $owner->email;
                    $mail_data['first_name']   = $owner->info->first_name;
                    $mail_data['thank'] = $static_data['strings']['you_have_received_new_booking'];


                     // Create the mail and send it
                    Mail::send('emails.booked', ['mail_data' => $mail_data], function ($m) use ($mail_data) {
                        $m->from($mail_data['admin_email'], $mail_data['site_name']);
                        $m->to($mail_data['email'], $mail_data['first_name'])->subject($mail_data['subject']);
                    }); 
                }

                Session::forget('params');
                return redirect()->route('book_payment_thank_you');
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
                return view('home.payment.status', compact('static_data', 'default_language'));
            }
        }
        Session::flash('payment_status', ['status' => false, 'msg' => $static_data['strings']['something_happened']]);
        return view('home.payment.status', compact('static_data', 'default_language'));
    }

    public function paymentCancel(){
        $default_language = default_language();
        $static_data = static_home();

        Session::flash('payment_status', ['status' => false, 'msg' => $static_data['strings']['canceled_payment']]);
        return view('home.payment.status', compact('static_data', 'default_language'));
    }

    public function paymentThankYou(){
        $default_language = default_language();
        $static_data = static_home();

        Session::flash('payment_status', ['status' => true, 'msg' => $static_data['strings']['thank_you_pay_booking']]);
        return view('home.payment.status', compact('static_data', 'default_language'));
    }
}
