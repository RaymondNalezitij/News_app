<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class PostEditJob implements ShouldQueue
{
    private int $postId;
    private string $text;

    public function __construct(int $postId, string $text)
    {
        $this->postId = $postId;
        $this->text = $text;
    }

    public function handle(): void
    {
        Post::where('id', $this->postId)->update(["text" => $this->text]);
    }
}
