<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostList extends Component
{
    public  $posts = [];
    public $count = 10;
    public $userId;
    public $hasMore = true; // Permet de savoir s'il reste des posts à charger

    public function mount($userId = null)
    {
        $this->userId = $userId;
        $this->loadPosts();
    }

    public function loadMore()
    {
        if (!$this->hasMore) return; // Empêche le chargement s'il n'y a plus de posts

        $this->count += 10;
        $this->loadPosts();
    }

    private function loadPosts()
    {
        $query = Post::latest();

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
