<?php

namespace App\Http\Resources\Frontend\Post\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="FrontendCommentResource",
     *     type="object",
     *     required={"id", "post_id", "description", "created_at", "author"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="post_id", type="integer", example=1),
     *     @OA\Property(property="description", type="string", example="This is a comment"),
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
            'post_id' => $this->post_id,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
