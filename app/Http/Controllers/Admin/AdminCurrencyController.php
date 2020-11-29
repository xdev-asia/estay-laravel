<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class AdminCurrencyController extends Controller
{
    public function index()
    {
        $currencies = currency()->getCurrencies();
        return view('admin.settings.currency', compact('currencies'));
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            currency()->delete($id);
            return response()->json(get_string('success_delete'), 200);
        } else {
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Storing Feature
    public function store(Request $request)
    {
        /* if($request->position){
            $position = '1 '.$request->symbol;
        }else{
            $position = $request->symbol .' 1';
        } */
        $data = [
            'name' => $request->name,
            'code' => $request->code,
            'symbol' => $request->symbol,
            'format' => '1' . $request->symbol . ',0.0',
            'exchange_rate' => $request->exchange_rate,
            'active' => 1,
        ];
        currency()->create($data);

        Artisan::call('currency:cleanup');

        // Refresh the page
        return redirect()->back();
    }
}
