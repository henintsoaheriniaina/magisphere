<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeButton extends Component
{
    public $post;
    public $isLiked;
    public $likeCount;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->isLiked = $post->isLikedByUser();
        $this->likeCount = $post->likes()->count();
    }

    public function toggleLike()
    {
        if ($this->isLiked) {
            $this->post->likes()->where('user_id', Auth::user()->id)->delete();
            $this->likeCount--;
        } else {
            $this->post->likes()->create(['user_id' => Auth::user()->id]);
            $this->likeCount++;
        }

        $this->isLiked = !$this->isLiked;
    }

    public function render()
    {
        return view('livewire.like-button');
    }
}
