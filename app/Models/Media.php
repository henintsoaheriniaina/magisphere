<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    protected $fillable = [
        'post_id',
        'url',
        'public_id',
        'name',
        'size',
        'type'
    ];
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
