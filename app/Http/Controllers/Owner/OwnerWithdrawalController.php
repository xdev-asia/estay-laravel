<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Withdrawal;
use App\Models\Admin\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OwnerWithdrawalController extends Controller
{
    protected $user;
    public function __construct(){
        $this->user = Auth::user();
    }

    public function index(){
        $user = $this->user;
        $withdrawals = Withdrawal::orderBy('created_at', 'desc')->where('user_id', $user->id)->paginate(10);
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        return view('owner.withdrawal', compact('withdrawals', 'currency'));
    }

    public function request(Request $request){

        // Validate Request
        $this->validate($request, [
            'method' => 'required',
            'amount' => 'required',
            'data'   => 'required',
        ]);

        $owner = Owner::where('user_id', $this->user->id)->first();

        if($request->amount > $owner->active_balance){

            // Not Enought Balance
            Session::flash('withdrawal_request', false);
            return redirect()->back();


        }else{

            // Get Data
            $data = $request->all();

            // Get Payment Method
            switch($request->method){
                case 0: $data['method'] = 'PayPal'; break;
                case 1: $data['method'] = 'Bank Transfer'; break;
            }

            $data['user_id'] = $this->user->id;
            $owner->active_balance -= $request->amount;
            $owner->save();

            // Redirect Back
            Withdrawal::create($data);
            return redirect()->route('owner_withdrawal');
        }
    }

    public function userInfo(Request $request, $id){
        if($request->ajax()) {
            $withdrawal = Withdrawal::findOrFail($id);
            return response()->json($withdrawal->data, 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
