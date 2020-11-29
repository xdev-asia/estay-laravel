<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AdminHelper;
use App\Http\Requests\Admin\AdminAccount;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('admin.my_account', compact('user'));
    }

    public function update(AdminAccount $request, $id)
    {

        /* Getting the admin */
        $user = User::findOrFail($id);

        /* Updating Avatar, Deleting old avatar from server */
        $file = $request->file('avatar');
        if (isset($file) && $file->isValid()) {
            $path = public_path() . $user->admin->avatar;
            if(isset($user->admin->avatar) && file_exists($path)) unlink($path);
            $photo_name =  uniqid() .'.'. $file->getClientOriginalExtension();
            $file->move('images/admin/', $photo_name);
            $user->admin->avatar = $photo_name;
        }

        /* Updating admin information */
        $data = $request->only(['first_name', 'last_name', 'address', 'city', 'state', 'zip', 'country', 'company']);
        $user->admin->update($data);
        $user->admin->save();

        /* Updating admin data & modifying timestamps  */
        $data = $request->only(['username', 'email']);
        if($request->password){$data['password'] = bcrypt($request->password);}
        $user->update($data);
        $user->touch();
        unset($data);

        Session::flash('account_updated', true);
        /* Return to the edit page */
        return redirect()->back();
    }
}
