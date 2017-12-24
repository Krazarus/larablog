<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;

class LikesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Post $post)
    {
        if (!$post->likes()->where(['user_id' => auth()->id()])->exists()){
            Like::create([
                'user_id' => auth()->id(),
                'liked_id' => $post->id,
                'liked_type' => get_class($post)
            ]);
            return back();
        }
        return back();
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Post $post)
    {
        $post->likes()->where(['user_id' => auth()->id()])->delete();
        return back();
    }
}
