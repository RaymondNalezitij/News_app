<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class PostCreateJob implements ShouldQueue
{
    private string $text;

    public function __construct(String $text)
    {
        $this->text = $text;
    }

    public function handle(): void
    {
        $newPost = new Post([
            'user_id' => Auth::id(),
            'text' => $this->text,
        ]);
        $newPost->save();
    }
}
