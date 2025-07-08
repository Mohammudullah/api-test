<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'image',
        'user_id',
    ];


    protected $visible = [
        'id',
        'user_id',
        'title',
        'description',
        'image',
        'user',
        'created_at',
        'updated_at',
    ];


    public function scopeMine($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
