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

class OwnerPointController extends Controller
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

    public function index(){
        $currency = get_setting('currency_code', 'site');
        $points = get_string('points');
        $packages = [];
        $packages[1] = '10 '.$points.' - ' .get_setting('package_10', 'payment') .' '.$currency;
        $packages[2] = '30 '.$points.' - ' .get_setting('package_30', 'payment') .' '.$currency;
        $packages[3] = '50 '.$points.' - ' .get_setting('package_50', 'payment') .' '.$currency;
        $packages[4] = '100 '.$points.' - ' .get_setting('package_100', 'payment') .' '.$currency;
        $packages[5] = '200 '.$points.' - ' .get_setting('package_200', 'payment') .' '.$currency;
        $gateways = [];
        if(get_setting('allow_paypal', 'payment')){
            $gateways[0] = 'PayPal';
        }
        if(get_setting('allow_stripe', 'payment')){
            $gateways[1] = 'Stripe';
        }
        $gateways[2] = get_string('active_balance');
        if(!count($gateways)){
            $gateways[] = 'None';
        }
        return view('owner.point', compact('packages', 'gateways'));
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
                'cancelUrl' 	=> route('payment_point_cancel'),
                'returnUrl' 	=> route('payment_point_success'),
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
                return view('owner.point');
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
                    $user->points += $params['points'];
                    Purchase::create([
                        'user_id'   => $params['user_id'],
                        'method'    => 'Stripe',
                        'price'     => $params['amount'],
                        'points'    => $params['points'],
                        'transaction'  => isset($stripeResponse['id']) ? $stripeResponse['id'] : '',
                    ]);
                    $user->save();
                    Session::forget('params');
                    return redirect()->route('payment_thank_you');
                }else{
                    Session::flash('payment_status', ['status' => false, 'msg' => get_string('something_happened')]);
                    return view('owner.point');
                }
            }elseif($response->isRedirect()) {
                $response->redirect();
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
                return view('owner.point');
            }
        }else if($request->gateway == 2){
            $user = Owner::where('user_id', $request->user_id)->first();
            if($user->active_balance >= $price){
                Purchase::create([
                    'user_id'   => $request->user_id,
                    'method'    => 'Active Balance',
                    'price'     => $price,
                    'points'    => $data['points'],
                    'transaction'  => uniqid(),
                ]);
                $user->active_balance -= $price;
                $user->points += $data['points'];
                $user->save();
                Session::forget('params');
                return redirect()->route('payment_thank_you');
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => get_string('not_enough_balance')]);
                return view('owner.point');
            }
        }
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
                $user->points += $params['points'];
                Purchase::create([
                    'user_id'   => $params['user_id'],
                    'method'    => 'PayPal',
                    'price'     => $params['amount'],
                    'points'    => $params['points'],
                    'transaction'  => isset($paypalResponse['PAYMENTINFO_0_TRANSACTIONID']) ? $paypalResponse['PAYMENTINFO_0_TRANSACTIONID'] : '',
                ]);
                Session::forget('params');
                $user->save();
                return redirect()->route('payment_thank_you');
            }else{
                Session::flash('payment_status', ['status' => false, 'msg' => $response->getMessage()]);
                return view('owner.point');
            }
        }
        Session::flash('payment_status', ['status' => false, 'msg' => get_string('something_happened')]);
        return view('owner.point');
    }

    public function paymentCancel(){
        Session::flash('payment_status', ['status' => false, 'msg' => get_string('canceled_payment')]);
        return view('owner.point');
    }
}
