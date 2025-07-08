<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * @OA\Schema(
    *   schema="PostCollection",
    *   type="object",
    *   @OA\Property(
    *     property="data",
    *     type="array",
    *     @OA\Items(ref="#/components/schemas/PostResource")
    *   ),
    *   @OA\Property(
    *     property="links",
    *     type="object",
    *     @OA\Property(property="first", type="string", format="url", example="http://127.0.0.1:8000/api/posts?page=1"),
    *     @OA\Property(property="last", type="string", format="url", example="http://127.0.0.1:8000/api/posts?page=1"),
    *     @OA\Property(property="prev", type="string", format="url", nullable=true, example=null),
    *     @OA\Property(property="next", type="string", format="url", nullable=true, example=null)
    *   ),
    *   @OA\Property(
    *     property="meta",
    *     type="object",
    *     @OA\Property(property="current_page", type="integer", example=1),
    *     @OA\Property(property="from", type="integer", example=1),
    *     @OA\Property(property="last_page", type="integer", example=1),
    *     @OA\Property(
    *       property="links",
    *       type="array",
    *       @OA\Items(
    *         type="object",
    *         @OA\Property(property="url", type="string", format="url", nullable=true),
    *         @OA\Property(property="label", type="string", example="&laquo; Previous"),
    *         @OA\Property(property="active", type="boolean")
    *       )
    *     ),
    *     @OA\Property(property="path", type="string", format="url", example="http://127.0.0.1:8000/api/posts"),
    *     @OA\Property(property="per_page", type="integer", example=20),
    *     @OA\Property(property="to", type="integer", example=3),
    *     @OA\Property(property="total", type="integer", example=3)
    *   )
    * )
     *
     */

    public function toArray(Request $request)
    {
        return PostResource::collection($this->collection);
    }
}
