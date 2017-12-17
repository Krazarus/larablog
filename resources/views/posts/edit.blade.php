@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit post:</h1>

        <form action="/posts/{{ $post->id }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required
                       value="{{ $post->title }}">
            </div>

            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" name="file" value="{{ $post->thumbnail }}">
                <p class="help-block">Example block-level help text here.</p>
            </div>

            <div class="form-group">
                <input id="trix" type="hidden" name="body" value="{{ $post->body }}">
                <trix-editor input="trix"></trix-editor>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
                <a class="btn btn-default" href="/posts/{{ $post->id }}">Cancel</a>
            </div>

        </form>
        @if(count($errors))
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
