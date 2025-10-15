<?php

namespace App\Http\Resources\Frontend\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="FrontendPostResource",
     *     type="object",
     *     required={"id", "title", "subtitle", "created_at", "author", "image_url"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="title", type="string", example="My First Post"),
     *     @OA\Property(property="subtitle", type="string", example="This is my post subtitle..."),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="author", type="string", example="John Doe"),
     *     @OA\Property(property="image_url", type="string", example="https://example.com/image.jpg"),
     *    @OA\Property(property="comment_count", type="integer", example=5),
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'author' => $this->user->name,
            'created_at' => $this->created_at,
            'image_url' => $this->image_url,
            'comment_count' => $this->comments()->count(),
        ];
    }
}
