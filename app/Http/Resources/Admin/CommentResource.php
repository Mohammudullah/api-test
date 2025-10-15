<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="CommentResource",
     *     type="object",
     *     required={"id", "name", "email", "description"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="post_id", type="integer", example=2),
     *     @OA\Property(property="name", type="string", example="Jane Doe"),
     *     @OA\Property(property="email", type="string", format="email", example="jane@example.com"),
     *     @OA\Property(property="description", type="string", example="This is a comment"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
