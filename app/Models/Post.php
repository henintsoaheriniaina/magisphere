<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
        'description',
        'user_id',
        'views',
        'category',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function medias(): HasMany
    {
        return $this->hasMany(Media::class);
    }
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function likesCount()
    {
        return $this->likes()->count();
    }
}
