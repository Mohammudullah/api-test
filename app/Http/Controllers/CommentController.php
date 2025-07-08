<?php

namespace App\Http\Controllers;

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
     * Display a listing of the resource.
     */
    public function index(Post $post)
    {
        return $post->comments()->paginate(20);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if(Post::find($request->post_id)?->user_id !== Auth::user()->id) {
            abort(404);
        }

        $request->validate([
            'post_id' => 'required|integer|exists:posts,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
        ]);

        $comment = ModelsComment::create([
            'post_id' => $request->post_id,
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ModelsComment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ModelsComment $comment)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $comment->update([
            'description' => $request->description,
        ]);

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ModelsComment $comment)
    {
        $comment->delete();
    }
}
