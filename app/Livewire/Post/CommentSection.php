<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentSection extends Component
{
    public Post $post;
    public string $newComment = '';
    public bool $details = false;
    public int $perPage = 5;

    protected $rules = [
        'newComment' => 'required|string|max:500',
    ];

    protected $messages = [
        'newComment.required' => 'Le commentaire est requis.',
        'newComment.string' => 'Le commentaire doit être une chaîne de caractères.',
        'newComment.max' => 'Le commentaire ne peut pas dépasser 500 caractères.',
    ];

    public function postComment()
    {
        $this->validate();

        $this->post->comments()->create([
            'user_id' => Auth::id(),
            'content' => $this->newComment,
        ]);
        $this->newComment = ''; // Vide la variable
        $this->dispatch('$refresh');
    }

    public function loadMore()
    {
        $this->perPage += 5;
    }
    public function showLess()
    {
        $this->perPage = 1;
    }


    public function render()
    {
        $comments = $this->post->comments()->latest()->take($this->perPage)->get();
        $total = $this->post->comments()->count();

        return view('livewire.post.comment-section', [
            'comments' => $comments,
            'hasMore' => $total > $this->perPage,
            'isExtended' => $this->perPage > 1,
        ]);
    }
    public function deleteComment($commentId)
    {
        $comment = $this->post->comments()->find($commentId);

        if ($comment && $comment->user_id === Auth::id()) {
            $comment->delete();
        }
    }
}
