<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Activity;
use App\Models\Admin\Booking;
use App\Models\Admin\Owner;
use App\Models\Admin\Property;
use App\Models\Admin\Withdrawal;
use App\Models\Admin\Purchase;
use App\Models\Admin\Review;
use App\Models\Admin\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminOwnerController extends Controller
{
    public function index(){
        $owners = Owner::paginate(10);
        return view('admin.owner.owner', compact('owners'));
    }

    public function edit($id){
        $owner = Owner::findOrFail($id);
        return view('admin.owner.edit', compact('owner'));
    }

    // Activating user
    public function activate(Request $request, $id){
        if($request->ajax()) {
            $user = Owner::findOrFail($id);
            $user->status = 1;
            $user->touch();
            $user->save();
            return response()->json(get_string('success_activate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Deactivating user
    public function deactivate(Request $request, $id){
        if($request->ajax()) {
            $user = Owner::findOrFail($id);
            $user->status = 0;
            $user->touch();
            $user->save();
            return response()->json(get_string('success_deactivate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Helper function for delete
    public function delete(Request $request, $id){
        if($request->ajax()) {
            $user = Owner::findOrFail($id);
            if(Property::where('user_id', $user->user_id)->first() || Service::where('user_id', $user->user_id)->first() || Review::where('user_id', $user->user_id)->first() || Booking::where('user_id', $user->user_id)->first()){
                return response()->json(get_string('connected_item'), 400);
            }else{
                // Get the user

                // Delete its information and its avatar (if exists)
                if(isset($user->logo) && File::exists($user->logo)) File::delete($user->logo);
                $user->user->delete();

                // Delete user
                $user->delete();
                return response()->json(get_string('success_delete'), 200);
            }
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function update(Request $request, $id){

        $this->validate($request, [
            'username' => 'min:6|max:16|required|unique:users,username,' . $request->user_id,
            'email' => 'email|required|unique:users,email, ' . $request->user_id,
            'first_name' => 'max:16',
            'last_name' => 'max:16',
            'company' => 'max:20',
            'address' => 'max:20',
            'city' => 'max:20',
            'country' => 'max:20',
            'state' => 'max:20',
            'zip' => 'max:20',
            'password' => 'min:6|confirmed',
            'logo' => 'image|dimensions:max_width=300',
        ], [
            'username.min'          => get_string('min_6'),
            'username.max'          => get_string('max_16'),
            'first_name'            => get_string('max_16'),
            'last_name'             => get_string('max_16'),
            'city'                  => get_string('max_20'),
            'state'                 => get_string('max_20'),
            'address'               => get_string('max_20'),
            'company'               => get_string('max_20'),
            'zip'                   => get_string('max_20'),
            'country'               => get_string('max_20'),
            'username.required'     => get_string('required_field'),
            'username.unique'       => get_string('not_unique_field'),
            'email.required'        => get_string('required_field'),
            'email.unique'          => get_string('not_unique_field'),
            'avatar.image'          => get_string('not_valid_image'),
            'password.min'          => get_string('min_6'),
            'password.confirmed'    => get_string('password_confirmed_error'),
            'avatar.dimensions'     => get_string('max_dimension_300'),
        ]);

        /* Getting the admin */
        $user = Owner::findOrFail($id);

        /* Updating Avatar, Deleting old avatar from server */
        $file = $request->file('logo');
        if (isset($file) && $file->isValid()) {
            $path = public_path() . $user->logo;
            if(isset($user->logo) && file_exists($path)) unlink($path);
            $photo_name =  uniqid() .'.'. $file->getClientOriginalExtension();
            $file->move('images/owner/', $photo_name);
            $user->logo = $photo_name;
        }

        /* Updating admin information */
        $data = $request->only(['first_name', 'last_name', 'address', 'city', 'state', 'zip', 'country', 'points', 'status', 'company', 'active_balance', 'pending_balance']);
        $user->update($data);

        /* Updating user & modifying timestamps  */
        $data = $request->only(['username', 'email']);
        if($request->password){$data['password'] = bcrypt($request->password);}
        $user->user->update($data);
        $user->user->touch();
        $user->user->save();
        $user->touch();
        $user->save();
        unset($data);

        /* Return to the edit page */
        return redirect('/admin/owner');
    }

    public function deleteImage(Request $request, $id){
        if($request->ajax()) {
            $user = Owner::findOrFail($id);
            $user->logo = 'no_image.jpg';
            $user->touch();
            $user->save();
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    public function allservices($id){
        $services = Service::where('user_id', $id)->orderBy('created_at','desc')->paginate(10);
        $user = Owner::where('user_id', $id)->first()->user->username;
        return view('admin.service.user_index', compact('services', 'user'));
    }

    public function allproperties($id){
        $properties = Property::where('user_id', $id)->orderBy('created_at','desc')->paginate(10);
        $user = Owner::where('user_id', $id)->first()->user->username;
        return view('admin.property.user_index', compact('properties', 'user'));
    }

    public function allpurchases($id){
        $purchases = Purchase::where('user_id', $id)->orderBy('created_at','desc')->paginate(10);
        $user = Owner::where('user_id', $id)->first()->user->username;
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        return view('admin.owner.purchase_index', compact('purchases', 'user', 'currency'));
    }

    public function allactivities($id){
        $activities = Activity::where('user_id', $id)->orderBy('created_at','desc')->paginate(10);
        $user = Owner::where('user_id', $id)->first()->user->username;
        return view('admin.owner.activity_index', compact('activities', 'user'));
    }

    public function allwithdrawals($id){
        $withdrawals = Withdrawal::where('user_id', $id)->orderBy('created_at','desc')->paginate(10);
        $currency_code = get_setting('currency_code', 'site');
        $currency = currency()->getCurrency($currency_code);
        $currency = $currency['symbol'] ? $currency['symbol'] : '';
        $user = Owner::where('user_id', $id)->first()->user->username;
        return view('admin.owner.withdrawal_index', compact('withdrawals', 'user', 'currency'));
    }

    // Autocomplete
    public function autocomplete(Request $request){

        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];

            $users = User::where([['username', 'LIKE', '%' . $term . '%'],['role_id', 2]])->take(5)->get();
            foreach ($users as $user) {
                $results[] = ['id' => $user->id, 'title' => $user->username];
            }
            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching blog posts
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';
        $owners = User::where([['username', 'LIKE', '%'.$term.'%'],['role_id', 2]])->paginate(10);
        return view('admin.owner.search', compact('owners'));
    }
}
