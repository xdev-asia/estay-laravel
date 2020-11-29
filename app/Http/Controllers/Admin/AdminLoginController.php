<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Booking;
use App\Models\Admin\Property;
use App\Models\Admin\Purchase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Visitor;

class AdminLoginController extends Controller
{
    public function index(){

        if(Auth::check() && Auth::user()->isAdmin()){
            return redirect()->route('admin_dashboard');
        }else if(Auth::check()) {
            return redirect('/');
        }else{
            return view('admin.auth.login');
        }
    }

    public function resetPassword(){
        if(Auth::check() && Auth::user()->isAdmin()){
            return redirect()->route('admin_dashboard');
        }else{
            return view('admin.auth.reset');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function booksi(){
        return view('admin.booksi');
    }

    public function dashboard(){

        // Statistics data
        $data['new_properties'] = count(Property::where('created_at', '>=', Carbon::yesterday()->subDay())->get());
        $data['new_bookings'] = count(Booking::where('created_at', '>=', Carbon::yesterday()->subDay())->get());
        $data['new_members'] = count(User::where('created_at', '>=', Carbon::yesterday()->subDay())->get());
        $data['new_visits'] = Visitor::range(Carbon::yesterday(), Carbon::today());
        $data['data_range'] = generateDateRange(Carbon::today()->subDays(5), Carbon::yesterday());

        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';

        // Tables
        $bookings = Booking::orderBy('created_at', 'desc')->take(6)->get();
        $purchases = Purchase::orderBy('created_at', 'desc')->take(6)->get();

        // Charts data
        $data['purchases_data'] = '['. implode(',', getChartData('purchase')). ']';
        $data['visits_data'] = '['. implode(',', getChartData('visits')). ']';
        $data['bookings_data'] = '['. implode(',', getChartData('booking')). ']';
        return view('admin.dashboard', compact('data', 'bookings', 'purchases', 'currency'));
    }

}
