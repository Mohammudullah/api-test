<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getSubtitleAttribute()
    {
        return Str::limit($this->description, 100, preserveWords: true);
    }
}
