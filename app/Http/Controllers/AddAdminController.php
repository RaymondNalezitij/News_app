<?php

namespace App\Http\Controllers;

use App\Models\AdminRole;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AddAdminController extends Controller
{
    public function create(): view
    {
        return view('addAdmins', data: [
            'currentUserAdminCheck' => AdminRole::select('is_admin_at')
                ->where('user_id', Auth::id())
                ->get(),
            'users' => User::select('id','name')->get(),
            'AdminRoles' => AdminRole::select('id','user_id','is_admin_at')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        var_dump($request);die;
        foreach($request->request as $key => $value){

            if($key !== '_token') {
                if ($value == 'on') {
                    AdminRole::where('id', $key)->update(['is_admin_at' => 'dashboard']);
                } else {
                    AdminRole::where('id', $key)->update(['is_admin_at' => '']);
                }
            }
        }
        return Redirect::route('addAdmins');
    }
}
