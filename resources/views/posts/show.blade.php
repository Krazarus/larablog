@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                @if($post->checkCreator())
                    <div class="pull-right">
                        <form action="/posts/{{ $post->id }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="row">
                                <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </div>
                        </form>

                    </div>
                @endif

                {{--{{dd($post->checkCreator())}}--}}
                <h1>{{ $post->title }}</h1>
                @if($post->isUpdated())
                    <p>created: {{ $post->created_at->diffForHumans() }}</p>
                    <p>last updated: {{ $post->updated_at->diffForHumans() }}</p>
                @else
                    <p>created: {{ $post->created_at->diffForHumans() }}</p>
                @endif
                <p>{{ $post->creator->name }}</p>
                <hr>
                @if($post->thumbnail != '')
                    <img src="{{ $post->path() }}" class="img-responsive">
                    <hr>
                @endif
                <p>{!!$post->body !!}</p>
                {{--{{ $post->test() }}--}}
            </div>
        </div>
    </div>
@endsection