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
                'postCreateText' => ['required'],
            ]);

            $newPost = new Post([
                'user_id' => Auth::id(),
                'text' => $request->postText,
            ]);
            $newPost->save();

        } else if (isset($_POST['deletePost'])) {
            $this->validate($request, [
                'createdAt' => ['required'],
            ]);

            Post::where('created_at', $request->createdAt)->delete();

        } else if (isset($_POST['editPost'])) {
            $this->validate($request, [
                'createdAt' => ['required'],
                'postEditText' => ['required'],
            ]);

            Post::where('created_at', $request->createdAt)->update(["text" => $request->postEditText]);
        }

        return Redirect::route('dashboard');
    }
}
