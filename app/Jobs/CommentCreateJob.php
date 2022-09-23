<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class CommentCreateJob implements ShouldQueue
{

    private int $postId;
    private string $commentText;
    private int $userId;

    public function __construct(int $postId, string $commentText, int $userId)
    {
        $this->postId = $postId;
        $this->commentText = $commentText;
        $this->userId = $userId;
    }

    public function handle()
    {
        $newComment = new Comment([
            'user_id' => $this->userId,
            'post_id' => $this->postId,
            'text' => $this->commentText,
        ]);
        $newComment->save();
    }
}
