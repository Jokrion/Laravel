<?php

namespace App\Observers;

use App\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    public function deleting(Post $post)
    {
        if($post->picture()->exists()){
            Storage::delete($post->picture->link);
        }
    }
}
