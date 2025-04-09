<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    public int $usersPage = 1;

    #[Url(except: '')]
    public string $query = '';
    public int $postsPage = 1;


    public function updatingQuery()
    {
        $this->resetPage();
        $this->usersPage = 1;
        $this->postsPage = 1;
    }

    public function loadMoreUsers()
    {
        $this->usersPage++;
    }

    public function loadMorePosts()
    {
        $this->postsPage++;
    }

    public function render()
    {
        $users = User::query()
            ->where(function ($query) {
                $query->where('firstname', 'like', '%' . $this->query . '%')
                    ->orWhere('lastname', 'like', '%' . $this->query . '%')
                    ->orWhere('email', 'like', '%' . $this->query . '%');
            })
            ->latest()
            ->limit($this->usersPage * 6)
            ->get();
        $posts = Post::query()
            ->where('description', 'like', '%' . $this->query . '%')
            ->latest()
            ->limit($this->postsPage * 6)
            ->get();

        return view('livewire.search', [
            'users' => $users,
            'posts' => $posts,
        ]);
    }
}
