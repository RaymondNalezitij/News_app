<?php

namespace App\Http\Controllers;

use App\Jobs\CommentCreateJob;
use App\Jobs\CommentDeleteJob;
use App\Jobs\CommentEditJob;
use App\Jobs\PostCreateJob;
use App\Jobs\PostDeleteJob;
use App\Jobs\PostEditJob;
use App\Models\AdminRole;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
            'posts' => Post::select('*')->get()->reverse(),
            'comments' => Comment::select('*')->get()->reverse(),
            'users' => User::select('id','name'),
            'AdminRoles' => AdminRole::select('id','user_id','is_admin_at'),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (isset($_POST['createPost'])) {
            $this->validate($request, ['postCreateText' => ['required'],]);

            $this->dispatch(new PostCreateJob(
                $request->get('postCreateText')
            ));

        } else if (isset($_POST['deletePost'])) {
            $this->validate($request, ['postId' => ['required'],]);

            $this->dispatch(new PostDeleteJob(
                $request->get('postId')
            ));

        } else if (isset($_POST['editPost'])) {
            $this->validate($request, [
                'postId' => ['required'],
                'postEditText' => ['required'],
            ]);

            $this->dispatch(new PostEditJob(
                $request->get('postId'),
                $request->get('postEditText'),
            ));

        } else if (isset($_POST['createComment'])) {
            $this->validate($request, [
                'postId' => ['required'],
                'commentInput' => ['required'],
            ]);

            $this->dispatch(new CommentCreateJob(
                $request->get('postId'),
                $request->get('commentInput'),
                Auth::id()
            ));

        } else if (isset($_POST['deleteComment'])) {
            $this->validate($request, [
                'commentId' => ['required'],
            ]);

            $this->dispatch(new CommentDeleteJob(
                $request->get('commentId')
            ));

        } else if (isset($_POST['submitCommentEdit'])) {
            $this->validate($request, [
                'commentId' => ['required'],
                'commentEditText' => ['required'],
            ]);

            $this->dispatch(new CommentEditJob(
                $request->commentId,
                $request->commentEditText,
            ));

        }

        return Redirect::route('dashboard');
    }
}
