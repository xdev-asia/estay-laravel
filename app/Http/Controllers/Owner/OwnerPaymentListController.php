<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OwnerPaymentListController extends Controller
{
    protected $user;
    public function __construct(){
        $this->user = Auth::user();
    }

    public function index(){
        $payments = Payment::orderBy('created_at','desc')->where('owner_id', $this->user->id)->paginate(10);
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        return view('owner.list_payment', compact('payments', 'currency'));
    }

    public function details(Request $request, $id){
        if($request->ajax()) {
            $payment = Payment::findOrFail($id);
            return response()->json($payment->data, 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
