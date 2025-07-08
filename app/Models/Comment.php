<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;


    protected $fillable = [
        'post_id',
        'name',
        'email',
        'description',
    ];


    protected $visible = [
        'id',
        'post_id',
        'name',
        'email',
        'description',
        'created_at',
        'updated_at',
    ];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
