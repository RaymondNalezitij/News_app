<?php

namespace App\Jobs;

use App\Models\Comment;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentDeleteJob implements ShouldQueue
{
    private int $commentId;

    public function __construct(int $commentId)
    {
        $this->commentId = $commentId;
    }

    public function handle()
    {
        Comment::where('id', $this->commentId)->delete();
    }
}
