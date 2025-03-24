<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostList extends Component
{
    public $details = false;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $statusFilter = '';
    public $userFilter = '';
    public $dateFilter = '';

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $query = Post::query()->with('user', 'medias');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('description', 'like', "%{$this->search}%")
                    ->orWhereHas('user', function ($q) {
                        $q->where('firstname', 'like', "%{$this->search}%")
                            ->orWhere('lastname', 'like', "%{$this->search}%")
                            ->orWhere('matriculation', 'like', "%{$this->search}%");
                    });
            });
        }

        if (!empty($this->statusFilter)) {
            $query->where('status', $this->statusFilter);
        }

        if (!empty($this->userFilter) && is_numeric($this->userFilter)) {
            $query->where('user_id', intval($this->userFilter));
        }


        if (!empty($this->dateFilter)) {
            $query->whereDate('created_at', $this->dateFilter);
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $posts = $query->take($this->perPage)->get();

        return view('livewire.admin.post-list', compact('posts'));
    }
}
