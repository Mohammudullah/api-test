<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * Class UserResource
 * @OA\Schema(
 *     schema="UserResource",
 *     type="object",
 *     required={"name", "email", "profile_picture"},
 *     @OA\Property(property="name", type="string"),
 *     @OA\Property(property="email", type="string"),
 *     @OA\Property(property="profile_picture", type="string")
 * )
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'profile_picture' => $this->profile_picture_url, // Assuming you have a profile_picture field
        ];
    }
}
