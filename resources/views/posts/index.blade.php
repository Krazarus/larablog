@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-10">
                @foreach($posts as $post)
                <div class="col-md-8">
                    <strong><p>{{ $post->creator->name }}</p></strong>
                </div>
                <div class="col-md-4">
                    <p class="text-right">{{ $post->created_at->diffForHumans() }}
                        <br>
                        likes: <span class="badge badge-error">{{ $post->likes->count() }}</span> </p>
                </div>

                    <a href="/posts/{{ $post->id }}"><h3>{{ $post->title }}</h3></a>
                    <br>
                    <p>{!!  str_limit($post->body, 150) !!}</p>
                    <hr>
                @endforeach
            </div>
        </div>

        <div class="flash alert alert-{{ session('class') }} alert-dismissible" role="alert">
            {{ session('flash') }}
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection