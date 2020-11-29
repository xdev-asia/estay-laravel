<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Booking;
use App\Models\Admin\Property;
use App\Models\Admin\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Admin\Faq;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Visitor;

class OwnerLoginController extends Controller
{
    public function index(){

        if(Auth::check() && Auth::user()->isOwner()){
            return redirect()->route('owner_dashboard');
        }else if(Auth::check()) {
            return redirect('/');
        }else{
            return view('owner.auth.login');
        }
    }

    public function resetPassword(){
        if(Auth::check() && Auth::user()->isOwner()){
            return redirect()->route('owner_dashboard');
        }else{
            return view('owner.auth.reset');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function dashboard(){

        $user = Auth::user();
        // Tables
        $bookings = Booking::where('owner_id', $user->id)->orderBy('created_at', 'desc')->get();
        $purchases = Purchase::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        // Data
        $data['properties'] = count(Property::where('user_id', $user->id)->get());
        $data['active_balance'] = $user->owner->active_balance;
        $data['pending_balance'] = $user->owner->pending_balance;
        $data['points'] = $user->owner->points;

        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';

        $bookings = $bookings->take(6);
        $purchases = $purchases->take(6);
        return view('owner.dashboard', compact('bookings', 'purchases', 'user', 'data', 'currency'));
    }

    public function booksi(){
        return view('owner.booksi');
    }

    public function faq(){
        $faqs = Faq::all();
        return view('owner.faq', compact('faqs'));
    }

}
