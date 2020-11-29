<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Withdrawal;
use App\Models\Admin\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminWithdrawalController extends Controller
{
    public function index(){
        $withdrawals = Withdrawal::orderBy('created_at','desc')->paginate(10);
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        return view('admin.owner.withdrawal', compact('withdrawals', 'currency'));
    }

    // Complete request
    public function complete(Request $request, $id){
        if($request->ajax()) {
            $withdrawal = Withdrawal::findOrFail($id);
            $withdrawal->status = 1;
            $withdrawal->touch();
            $withdrawal->save();
            return response()->json(get_string('completed_request'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Complete request
    public function dismiss(Request $request, $id){
        if($request->ajax()) {
            $withdrawal = Withdrawal::findOrFail($id);
            $withdrawal->status = 0;

            // Edit User
            $user = Owner::where('user_id', $withdrawal->user_id)->first();
            $user->active_balance += $withdrawal->amount;
            $user->save();

            $withdrawal->touch();
            $withdrawal->save();
            return response()->json(get_string('dismissed_request'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Delete request
    public function delete(Request $request, $id){
        if($request->ajax()) {
            $withdrawal = Withdrawal::findOrFail($id);
            $withdrawal->delete();
            return response()->json(get_string('delete_request_completed'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
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
