<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostCard extends Component
{
    public $post;
    public $liked = false;
    public function mount(Post $post)
    {
        $this->post = $post;
        $this->liked = $this->checkIfLiked();
    }

    public function checkIfLiked()
    {
        return Auth::user()->likedPosts()->where('post_id', $this->post->id)->exists();
    }

    public function toggleLike()
    {
        if ($this->liked) {
            Auth::user()->likedPosts()->detach($this->post->id);
        } else {
            Auth::user()->likedPosts()->attach($this->post->id);
        }

        $this->liked = !$this->liked;

        $this->emit('postLiked');
    }

    public function render()
    {
        return view('livewire.post-card');
    }
}
