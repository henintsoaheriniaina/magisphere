<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    public function manage(User $verificator, User $user)
    {
        if ($verificator->hasRole('admin')) {
            return true;
        }

        if ($verificator->hasRole('verificator') && $verificator->affiliation_id === $user->affiliation_id) {
            return true;
        }
        return false;
    }
}
