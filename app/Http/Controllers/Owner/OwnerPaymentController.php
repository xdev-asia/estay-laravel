<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Owner;
use App\Models\Admin\Purchase;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Omnipay\Common\CreditCard;
use Omnipay\Omnipay;

class OwnerPaymentController extends Controller
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
    public function prices(){
        $settings = Setting::where('type', 'payment')->get()->pluck('value', 'key');
        $currency = get_setting('currency', 'site');
        return view('owner.price', compact('settings', 'currency'));
    }

    public function payment(Request $request)
    {
        $this->validate($request,[
            'package'   => 'required',
            'gateway'   => 'required',
        ],[
            'package.required'      => get_string('choose_your_package'),
            'gateway.required'      => get_string('choose_payment_method')
        ]);
        $add_points = get_string('add_points');
        $data['buy_points'] = get_string('buy_points_on') .' - '. get_setting('site_name', 'site');
        switch($request->package){
            case 1: $price = (float) get_setting('package_10', 'payment'); $data['points'] = 10; $data['package'] = $add_points .' - 10'; break;
            case 2: $price = (float) get_setting('package_30', 'payment'); $data['points'] = 30; $data['package'] = $add_points .' - 30'; break;
            case 3: $price = (float) get_setting('package_50', 'payment'); $data['points'] = 50; $data['package'] = $add_points .' - 50'; break;
            case 4: $price = (float) get_setting('package_100', 'payment'); $data['points'] = 100; $data['package'] = $add_points .' - 100'; break;
            case 5: $price = (float) get_setting('package_200', 'payment'); $data['points'] = 200; $data['package'] = $add_points .' - 200'; break;
        }
        if($request->gateway == 0){
            $params = [
                'cancelUrl' 	=> route('payment_cancel'),
                'returnUrl' 	=> route('payment_success'),
                'name'		    => $data['buy_points'],
                'description' 	=> $data['package'],
                'amount' 	    => $price,
                'currency' 	    => get_setting('currency_code', 'site'),
                'user_id'       => $request->user_id,
                'points'        => $data['points'],
                'package'       => $data['package'],
                'gateway'       => $request->gateway,
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
                return view('owner.dashboard');
            }
        }else if($request->gateway == 1){
            $params = [
                'name'		    => $data['buy_points'],
                'description' 	=> $data['package'],
                'amount' 	    => $price,
                'points'        => $data['points'],
                'package'       => $data['package'],
                'currency' 	    => get_setting('currency_code', 'site'),
                'token'         => $request->stripeToken,
                'gateway'       => $request->gateway,
                'user_id'       => $request->user_id,
            ];
            Session::put('params', $params);
            Session::save();
            $gateway = $this->stripe_gw;
            $response = $gateway->purchase($params)->send();
            if ($response->isSuccessful()) {
                $stripeResponse = $response->getData();
                if($stripeResponse['paid'] && $stripeResponse['status'] === 'succeeded'){
                    $user = Owner::where('user_id', $params['user_id'])->first();
                    $user->points = $params['points'] - get_setting('entrance_fee', 'payment');
                    $user->status = 1;
                    Purchase::create([
                        'user_id'   => $params['user_id'],
                        'method'    => 'Stripe',
                        'price'     => $params['amount'],
                        'points'    => $params['points'],
                        'transaction'  => isset($stripeResponse['id']) ? $stripeResponse['id'] : '',
                    ]);
                    $user->save();
                    return redirect()->route('payment_thank_you');
                }else{
                    Session::flash('payment_status', ['status' => false, 'msg' => get_string('something_happened')]);
                    return view('owner.dashboard');
                }
            }elseif($response->isRedirect()) {
                $response->redirect();
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
                return view('owner.dashboard');
            }
        }else if($request->gateway == 2){
            Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
        }
        return 0;
    }

    public function paymentSuccess()
    {
        $params = Session::get('params');
        if($params['gateway'] == 0){
            $gateway = $this->paypal_gw;
            $response = $gateway->completePurchase($params)->send();
            $paypalResponse = $response->getData();
            if(isset($paypalResponse['ACK']) && $paypalResponse['ACK'] === 'Success') {
                $user = Owner::where('user_id', $params['user_id'])->first();
                $user->points = $params['points'] - get_setting('entrance_fee', 'payment');
                $user->status = 1;
                Purchase::create([
                    'user_id'   => $params['user_id'],
                    'method'    => 'PayPal',
                    'price'     => $params['amount'],
                    'points'    => $params['points'],
                    'transaction'  => isset($paypalResponse['PAYMENTINFO_0_TRANSACTIONID']) ? $paypalResponse['PAYMENTINFO_0_TRANSACTIONID'] : '',
                ]);
                $user->save();
                return redirect()->route('payment_thank_you');
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
                return view('owner.dashboard');
            }
        }
        Session::flash('payment_status', ['status' => false, 'msg' => get_string('something_happened')]);
        return view('owner.dashboard');
    }

    public function paymentCancel(){
        Session::flash('payment_status', ['status' => false, 'msg' => get_string('canceled_payment')]);
        return view('owner.dashboard');
    }

    public function paymentThankYou(){
        Session::flash('payment_status', ['status' => true, 'msg' => get_string('thank_you_purchase')]);
        return redirect()->route('owner_dashboard');
    }
}
