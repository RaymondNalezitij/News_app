<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentEditJob implements ShouldQueue
{

    private int $commentId;
    private string $newCommentText;

    public function __construct(int $commentId, string $newCommentText)
    {
        $this->commentId = $commentId;
        $this->newCommentText = $newCommentText;
    }

    public function handle()
    {
        Comment::where('id', $this->commentId)->update(["text" => $this->newCommentText]);
    }
}
