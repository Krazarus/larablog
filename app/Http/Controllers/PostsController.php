<?php

namespace App\Http\Controllers;

use App\Filter;
use App\Http\Requests\StorePost;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $posts = DB::table('posts')
            ->latest()
            ->paginate(15);

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
     * @param StorePost $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        $name = $this->isThumbnail($request, request('file'));
        $post = Post::create([
            'title' => request('title'),
            'user_id' => auth()->id(),
            'body' => request('body'),
            'thumbnail' => $name,
        ]);
        return redirect($post->uri())
            ->with(['flash' => 'Your post has been create!',
                'class' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $message = 'Nice, now you can edit this post!';

        if ($post->checkCreator()){
            $message = 'You are admin, do what you want';
        }
        return view('posts.show', compact('post', 'message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
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
     * @param StorePost $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StorePost $request, $id)
    {

        $post = Post::find($id);

        $this->authorize('update', $post);

        if (request('file')) {
            $name = $this->isThumbnail($request, $post);
            $post->thumbnail = $name;
        }
        $post->title = request('title');
        $post->body = request('body');
        $post->update();

        return redirect("/posts/{$post->id}")
            ->with(['flash' => 'Your post has been update!',
                'class' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        $file = $post->path();
        if ($file) {
            if (is_readable(public_path($file))) {
                unlink(public_path($file));
            }
        }
        $post->delete();
        return redirect('/posts')
            ->with(['flash' => 'Your post has been deleted!',
                'class' => 'success']);
    }

    /**
     * @param Request $request
     * @param $post
     * @return string
     */
    protected function isThumbnail(Request $request, $post): string
    {
        $name = '';
        if ($request->has('file') && $post) {
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
