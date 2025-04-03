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

    public $typeFilter = '';
    public $statusFilter = '';

    public function mount($userId = null)
    {
        $this->userId = $userId;
        $this->loadPosts();
    }

    public function updatedTypeFilter()
    {
        $this->resetPagination();
    }

    public function updatedStatusFilter()
    {
        $this->resetPagination();
    }

    public function resetPagination()
    {
        $this->count = 10;
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
        if (!Auth::user()->hasRole('admin|moderator')) {
            $query->where('status', 'approved');
        }

        if ($this->userId) {
            $query->where('user_id', $this->userId);
        }

        if ($this->typeFilter) {
            $query->where('category', $this->typeFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        // Récupérer les nouveaux posts (collection Eloquent)
        $newPosts = $query->skip(count($this->posts))->take(10)->get();

        // Fusionner en gardant des objets Post
        $this->posts = collect($this->posts)->merge($newPosts);

        // Vérifier s'il reste encore des posts à charger
        $this->hasMore = $query->count() > $this->posts->count();
    }





    public function render()
    {
        return view('livewire.post-list');
    }
}
