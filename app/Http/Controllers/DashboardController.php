<?php

namespace App\Http\Controllers;

use App\Models\AdminRole;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function create(): view
    {
        $admin = AdminRole::select('is_admin_at')
            ->where('user_id', Auth::id())
            ->get();

        return view('dashboard', data: [
            'admin_status' => AdminRole::select('is_admin_at')
                ->where('user_id', Auth::id())
                ->get(),
            'posts' => Post::select('*')->get()
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (isset($_POST['createPost'])) {
            $this->validate($request, [
                'postText' => ['required'],
            ]);

            $newPost = new Post([
                'user_id' => Auth::id(),
                'text' => $request->postText,
            ]);
            $newPost->save();

        } else if (isset($_POST['deletePost'])) {
            $this->validate($request, [
                'postNumber' => ['required'],
            ]);

            var_dump($request->postNumber);
            die;

        } else if (isset($_POST['editPost'])) {
        }

        return Redirect::route('dashboard');
    }
}
