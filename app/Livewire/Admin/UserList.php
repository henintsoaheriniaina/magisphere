<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{
    public $search = '';
    public $sortField = 'lastname';
    public $details = false;

    public $sortDirection = 'asc';
    public $perPage = 10;

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
        $query = User::query()->with('affiliation', 'roles');


        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('firstname', 'like', "%{$this->search}%")
                    ->orWhere('lastname', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")
                    ->orWhere('matriculation', 'like', "%{$this->search}%")
                    ->orWhereHas('affiliation', function ($q) {
                        $q->where('label', 'like', "%{$this->search}%");
                    });
            });
        }

        if ($this->sortField === 'affiliation') {
            $query->join('affiliations', 'users.affiliation_id', '=', 'affiliations.id')
                ->orderBy('affiliations.label', $this->sortDirection)
                ->select('users.*');
        } elseif ($this->sortField === 'role') {
            $query->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
                ->orderBy('roles.name', $this->sortDirection)
                ->select('users.*');
        } else {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        $users = $query->take($this->perPage)->get();

        return view('livewire.admin.user-list', compact('users'));
    }
}
