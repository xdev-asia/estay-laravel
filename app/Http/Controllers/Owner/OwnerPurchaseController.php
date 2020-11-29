<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OwnerPurchaseController extends Controller
{
    public function index(){
        $purchases = Purchase::where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate(10);
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        return view('owner.purchase', compact('purchases', 'currency'));
    }

}
