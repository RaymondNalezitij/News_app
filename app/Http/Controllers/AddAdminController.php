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
            'users' => User::select('id', 'name')->get(),
            'AdminRoles' => AdminRole::select('id', 'user_id', 'is_admin_at')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (isset($_POST['removeAdmin'])) {
            AdminRole::where('user_id', $request->get('user_id'))->update(['is_admin_at' => '']);
        } else if (isset($_POST['makeAdmin'])) {
            AdminRole::where('user_id', $request->get('user_id'))->update(['is_admin_at' => 'dashboard']);
        }

        return Redirect::route('addAdmins');
    }
}
