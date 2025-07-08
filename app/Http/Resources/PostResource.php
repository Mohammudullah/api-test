<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="PostResource",
     *     type="object",
     *     required={"id", "title", "description", "created_at", "updated_at"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="title", type="string", example="My First Post"),
     *     @OA\Property(property="description", type="string", example="This is my post description"),
     *     @OA\Property(property="image", type="string", nullable=true, example=null),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image_url, // Assuming you have an image_url accessor
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
