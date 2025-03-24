<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    public function manage_posts(User $moderator, Post $post): Response
    {
        if ($moderator->hasRole('admin')) {
            return  Response::allow();
        }
        if ($moderator->hasRole('verificator') && $moderator->affiliation_id === $post->user->affiliation_id) {
            return  Response::allow();
        }
        return Response::deny('Vous ne pouvez gérer que les publications de votre affiliation.');;
    }
}
