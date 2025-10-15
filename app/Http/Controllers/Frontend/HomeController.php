<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Frontend\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/frontend/home/posts",
     *     summary="Get Featured and recent posts for homepage",
     *     tags={"Homepage"},
     *     @OA\Response(
     *         response=200,
     *         description="Featured post and list of recent posts",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="featured",
     *                 ref="#/components/schemas/FrontendPostResource"
     *             ),
     *             @OA\Property(
     *                 property="posts",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/FrontendPostResource")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {

        $featured = Post::inRandomOrder()->first();

        return [
            'featured' => new PostResource($featured),
            'posts' => PostResource::collection(
                Post::inRandomOrder()
                ->whereNot('id', $featured?->id)
                ->take(10)
                ->get()
            ),
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
