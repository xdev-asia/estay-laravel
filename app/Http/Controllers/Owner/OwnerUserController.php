<?php

namespace App\Http\Controllers\Owner;

use App\Models\Admin\Booking;
use App\Models\Admin\Owner;
use App\Models\Admin\Property;
use App\Models\Admin\Review;
use App\Models\Admin\Service;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class OwnerUserController extends Controller
{
    public function index(){
        $users = User::where('role_id', 3)->paginate(10);
        return view('admin.user.user', compact('users'));
    }

    // Get user info
    public function userinfo(Request $request){
        if($request->ajax()){
            $user = User::findOrFail($request->id);
            $data = [
                'first_name'    => $user->user->first_name,
                'last_name'     => $user->user->last_name,
                'email'         => $user->email,
                'username'      => $user->username
            ];
            return response()->json($data, 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Updating user
    public function update(Request $request){

        // We get the user
        $user = User::findOrFail($request->id);

        // Data for updating info
        $data = [
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
        ];

        // We update its info
        $user->user->update($data);
        $user->user->save();

        // Updating email, password and username (validating first)
        $this->validate($request, [
            'username' => 'required|max:16',
            'email' => 'required|unique:users,email,'.$request->id.',id',
            'password' => 'confirmed'
        ],[
            'username.required'     => get_string('required_field'),
            'username.max'          => get_string('max_16'),
            'email.unique'          => get_string('email_unique'),
            'email.required'        => get_string('required_field'),
            'password.confirmed'    => get_string('password_confirmed_error'),
        ]);
        $data = $request->only(['username', 'email']);
        if($request->password){$data['password'] = bcrypt($request->password);}
        $user->update($data);
        $user->touch();
        $user->save();

        // Returning after update
        return redirect('admin/user');
    }

    // Handling deleting
    public function destroy(Request $request, $id){
        if($request->ajax()){
            if(Property::where('user_id', $id)->first() || Service::where('user_id', $id)->first() || Review::where('user_id', $id) || Booking::where('user_id', $id)){
                return response()->json(get_string('connected_item'), 400);
            }else{
                $this->delete($id);
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Handling mass deletion
    public function massDestroy(Request $request){
        if($request->ajax() && isset($request->id)){
            $ids = $request->id;
            foreach ($ids as $id){
                if(Property::where('user_id', $id)->first() || Service::where('user_id', $id)->first() || Review::where('user_id', $id) || Booking::where('user_id', $id)){
                    return response()->json(get_string('connected_item'), 400);
                }else{
                    $this->delete($id);
                }
            }
            return response()->json(get_string('success_delete'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Activating user
    public function activate(Request $request, $id){

        if($request->ajax()) {
            $user = User::findOrFail($id);
            $user->is_active = 1;
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
            $user = User::findOrFail($id);
            $user->is_active = 0;
            $user->touch();
            $user->save();
            return response()->json(get_string('success_deactivate'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Autocomplete
    public function autocomplete(Request $request){
        if($request->ajax()) {
            $term = $request->get('term') ? $request->get('term') : '';
            $results = [];
            $users = User::where([['username', 'LIKE', '%' . $term . '%'],['role_id', 3]])->take(5)->get();

            foreach ($users as $user) {
                $results[] = ['id' => $user->blog_id, 'name' => $user->username];
            }
            return $results;
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }

    // Searching blog posts
    public function search(Request $request){
        $term = $request->get('term') ? $request->get('term') : '';

        $users = User::where([['username', 'LIKE', '%'.$term.'%'],['role_id', 3]])->paginate(10);

        return view('admin.user.search', compact('users'));
    }

    // Helper function for delete
    public function delete($id){

        // Get the user
        $user = User::findOrFail($id);

        // Delete its information and its avatar (if exists
        if(isset($user->user->avatar) && File::exists($user->user->avatar)) File::delete($user->user->avatar);
        $user->user->delete();

        // Delete user
        $user->delete();
    }

    // Upgrade user to Owner
    public function upgrade(Request $request, $id){

        if($request->ajax() && isset($request->id)){
            // Get the user
            $user = User::findOrFail($id);
            $user->role_id = 2;
            $user->is_active = 1;

            // Create owner info, and transfer user data
            $data = $user->user->toArray();
            $data['user_id'] = $id;
            Owner::create($data);
            $user->user->delete();
            $user->touch();
            $user->save();

            return response()->json(get_string('success_upgrade_user'), 200);
        }else{
            return response()->json(get_string('something_happened'), 400);
        }
    }
}
