<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminPaymentController extends Controller
{
    public function index(){
        $payments = Payment::orderBy('created_at','desc')->paginate(10);
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';

        $p = Payment::all();
        $total = 0; $total_other = 0; $total_admin = 0;
        foreach($p as $payment){
        	if($payment->owner_id == 1){
        		$total_admin += $payment->total;
        		$total += $payment->total;
        	}else{
        		$total_other += $payment->total;
        		$total = $total +  ($payment->total * ($payment->host_commission / 100));
        	}
        }
        return view('admin.payment', compact('payments', 'currency', 'total', 'total_admin', 'total_other'));
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
