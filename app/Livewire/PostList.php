<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    public $posts = [];
    public $count = 10;
    public $userId;

    public function mount($userId = null)
    {
        $this->userId = $userId;
        $this->loadPosts();
    }

    public function loadMore()
    {
        $this->count += 10;
        $this->loadPosts();
    }

    private function loadPosts()
    {
        $query = Post::latest()->take($this->count);

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        $this->posts = $query->get();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
