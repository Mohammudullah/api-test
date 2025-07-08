<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentCollection;
use App\Http\Resources\CommentResource;
use App\Models\Comment as ModelsComment;
use App\Models\Post;
use Dom\Comment;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller implements HasMiddleware
{

    /**
     * Create a new controller instance.
     */
    public static function middleware()
    {
        return [
            function (Request $request, $next) {
                if(request()->post && request()->post instanceof Post) {

                    if($request->post->user_id !== Auth::user()->id) {
                        abort(404);
                    }
                }
                
                if(request()->comment && request()->comment instanceof ModelsComment) {

                    if($request->comment?->post?->user_id !== Auth::user()->id) {
                        abort(404);
                    }
                }

                return $next($request);
            },
        ];
    }


    /**
     * @OA\Get(
     *     path="/api/posts/{post}/comments",
     *     summary="Get paginated comments for a post",
     *     tags={"Comments"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="post",
     *         in="path",
     *         required=true,
     *         description="Post ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of comments",
     *         @OA\JsonContent(ref="#/components/schemas/CommentCollection")
     *     )
     * )
     */
    public function index(Post $post)
    {
        return new CommentCollection($post->comments()->paginate(20));
    }


    /**
     * @OA\Post(
     *     path="/api/posts/{post}/comments",
     *     summary="Create a new comment",
     *     tags={"Comments"},
     *     security={{"sanctum":{}}},
     * @OA\Parameter(
     *        name="post",
     *       in="path",
     *       required=true,
     *      description="Post ID",
     *      @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Jane Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="jane@example.com"),
     *             @OA\Property(property="description", type="string", example="Nice post!")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment created",
     *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
     *     ),
     *     @OA\Response(response=404, description="Post not found or unauthorized"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request, Post $post)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
        ]);

        $comment = ModelsComment::create([
            'post_id' => $post->id,
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
        ]);

        return new CommentResource($comment);
    }

    /**
     * @OA\Get(
     *     path="/api/comments/{id}",
     *     summary="Get a single comment by ID",
     *     tags={"Comments"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Comment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment found",
     *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
     *     ),
     *     @OA\Response(response=404, description="Comment not found")
     * )
     */
    public function show(ModelsComment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * @OA\Put(
     *     path="/api/comments/{id}",
     *     summary="Update a comment",
     *     tags={"Comments"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Comment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"description"},
     *             @OA\Property(property="description", type="string", example="Updated comment content")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Comment updated",
     *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
     *     ),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(Request $request, ModelsComment $comment)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $comment->update([
            'description' => $request->description,
        ]);

        return new CommentResource($comment);
    }

    /**
     * @OA\Delete(
     *     path="/api/comments/{id}",
     *     summary="Delete a comment",
     *     tags={"Comments"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Comment ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Comment deleted successfully"),
     *     @OA\Response(response=404, description="Comment not found")
     * )
     */
    public function destroy(ModelsComment $comment)
    {
        $comment->delete();

        return response()->json(
            ['message' => 'Comment deleted successfully'],
            204
        );
    }
}
