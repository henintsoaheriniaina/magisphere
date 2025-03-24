<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostList extends Component
{
    /**
     * @var \Illuminate\Database\Eloquent\Collection|\App\Models\Post[]
     */
    public $posts = [];
    public $count = 10;
    public $userId;
    public $hasMore = true;

    public function mount($userId = null)
    {
        $this->userId = $userId;
        $this->loadPosts();
    }

    public function loadMore()
    {
        if (!$this->hasMore) return;

        $this->count += 10;
        $this->loadPosts();
    }

    private function loadPosts()
    {
        $query = Post::latest();
        if (!Auth::user()->hasROle('admin|moderator')) {
            $query->where("status", "approved");
        }

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        // Récupérer les publications demandées
        $this->posts = $query->take($this->count)->get();

        $this->hasMore = $query->count() > $this->posts->count();
    }

    public function render()
    {
        return view('livewire.post-list');
    }
}
