<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * PostsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        $name = $this->isThumbnail($request, '');
        $post = Post::create([
            'title' => request('title'),
            'user_id' => auth()->id(),
            'body' => request('body'),
            'thumbnail' => $name,
        ]);
//        dd($post->id);

        return redirect($post->uri());
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param  int $id
     * @return void
     */
    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = Post::find($id);
        if (!$post->checkCreator()){
            return redirect('/whoops');
        }
        if (request('file')) {
            $name = $this->isThumbnail($request, $post);
            $post->thumbnail = $name;
        }
        $post->title = request('title');
        $post->body = request('body');
        $post->update();
        return redirect("/posts/{$id}");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if (!$post->checkCreator()){
            return redirect('/whoops');
        }
        $file = $post->path();
        if ($file) {
            if (is_readable(public_path($file))){
                unlink(public_path($file));
            }
        }
        $post->delete();
        return redirect('/posts');
    }

    /**
     * @param Request $request
     * @param $post
     * @return string
     */
    protected function isThumbnail(Request $request, $post): string
    {
        $name = '';

        if ($request->has('file') && $post->thumbnail) {
            if (is_readable(public_path($post->path()))) {
                unlink(public_path($post->path()));
            }
            $name = $this->setFileName();
        } elseif ($request->has('file') || $post = '') {
            $name = $this->setFileName();
        }

        return $name;
    }

    /**
     * @return string
     */
    protected function setFileName(): string
    {
        $file = request('file');
        $name = 'public/images/' . time() . '-' . $file->getClientOriginalName();
        $file = $file->move(public_path() . '/images', $name);
        return $name;
    }


}
