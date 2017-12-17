@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-10">
                @foreach($posts as $post)
                    <a href="/posts/{{ $post->id }}"><h2>{{ $post->title }}</h2></a>
                    <p>{!!  $post->body !!}</p>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
@endsection