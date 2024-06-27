<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use App\Models\User;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'username',
        'text',
    ];
    
    // 23/06/2024 Jorgen - memperbaiki fitur like
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function likedByUser(User $user)
    {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
