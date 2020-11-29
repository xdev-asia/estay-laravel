<?php

namespace App\Http\Controllers\Owner;

use App\Helpers\AdminHelper;
use App\Http\Requests\Admin\AdminAccount;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OwnerController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        return view('owner.my_account', compact('user'));
    }

    public function update(AdminAccount $request, $id)
    {

        /* Getting the admin */
        $user = User::findOrFail($id);

        /* Updating Avatar, Deleting old avatar from server */
        $file = $request->file('avatar');
        if (isset($file) && $file->isValid()) {
            $path = public_path() . $user->owner->logo;
            if(isset($user->owner->logo) && file_exists($path)) unlink($path);
            $photo_name =  uniqid() .'.'. $file->getClientOriginalExtension();
            $file->move('images/owner/', $photo_name);
            $user->owner->logo = $photo_name;
        }

        /* Updating owner information */
        $data = $request->only(['first_name', 'last_name', 'address', 'city', 'state', 'zip', 'country', 'company']);
        $user->owner->update($data);
        $user->owner->save();

        /* Updating owner data & modifying timestamps  */
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
