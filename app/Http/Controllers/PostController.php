<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller implements HasMiddleware
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

                return $next($request);
            },
        ];
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::mine(Auth::user())->paginate(20);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Post::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => null,
            'user_id' => Auth::user()->id, // Assuming user with ID 1 exists
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        return $post;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => null, // Assuming no image upload for now
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {

        $post->delete();
    }
}
