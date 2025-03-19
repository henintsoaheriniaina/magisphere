<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $search = '';

    public function render()
    {
        $users = User::where('firstname', 'like', "%{$this->search}%")
            ->orWhere('lastname', 'like', "%{$this->search}%")
            ->orWhere('email', 'like', "%{$this->search}%")
            ->orWhere('matriculation', 'like', "%{$this->search}%")
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user-list', compact('users'));
    }
}
