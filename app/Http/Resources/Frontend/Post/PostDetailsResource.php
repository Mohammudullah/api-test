<?php

namespace App\Http\Resources\Frontend\Post;

use App\Http\Resources\Frontend\Post\Comment\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailsResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="FrontendPostDetailsResource",
     *     type="object",
     *     required={"id", "title", "description", "created_at", "author", "image_url"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="title", type="string", example="My First Post"),
     *     @OA\Property(property="description", type="string", example="This is my post description"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="author", type="string", example="John Doe"),
     *     @OA\Property(property="image_url", type="string", example="https://example.com/image.jpg"),
     *    @OA\Property(property="comments", type="array",
     *         @OA\Items(ref="#/components/schemas/CommentResource")
     *     )
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'author' => $this->user->name,
            'created_at' => $this->created_at,
            'image_url' => $this->image_url,
            'comments' => CommentResource::collection($this->comments),
        ];
    }
}
