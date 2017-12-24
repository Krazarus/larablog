@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                @if(($post->likes))
                    @can('delete', $post)
                        <div class="pull-right">
                            <form action="/posts/{{ $post->id }}" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <div class="row">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    @endcan
                    @can('update', $post)
                        <div class="pull-right" style="margin-right: 25px">
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
                        </div>

                        <div class="message alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            {{ $message }}
                        </div>
                    @endcan
                @endif

                @if(auth()->check())
                    @if($post->isLiked())
                        <div>
                            <form method="POST" action="/posts/{{$post->id}}/likes">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit"
                                        class="btn btn-danger">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    {{ $post->likes->count() }} {{ str_plural('Like',  $post->likes->count()) }}
                                </button>
                            </form>
                        </div>
                    @else
                        <div>
                            <form method="POST" action="/posts/{{$post->id}}/likes">
                                {{ csrf_field() }}
                                <button type="submit"
                                        class="btn btn-default">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    {{ $post->likes->count() }} {{ str_plural('Like',  $post->likes->count()) }}
                                </button>
                            </form>
                        </div>
                    @endif
                @endif

                    <br>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h1 class="panel-title">{{ $post->title }}</h1>
                        </div>
                        <div class="panel-body">
                            @if($post->isUpdated())
                                <p>This post created: {{ $post->created_at->diffForHumans() }} by <strong>{{ $post->creator->name }}</strong> </p>
                                <p>last updated: {{ $post->updated_at->diffForHumans() }}</p>
                            @else
                                <p>This post was created: {{ $post->created_at->diffForHumans() }} by <strong>{{ $post->creator->name }}</strong> </p>
                            @endif
                            <hr>
                            @if($post->thumbnail != '')
                                <img src="{{ $post->path() }}" class="img-responsive">
                                <hr>
                            @endif
                            <p>{!!$post->body !!}</p>
                        </div>
                    </div>
            </div>
        </div>

        <div class="flash alert alert-{{ session('class') }} alert-dismissible" role="alert">
            {{ session('flash') }}
        </div>


    </div>
@endsection