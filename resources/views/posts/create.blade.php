@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a new Post:</h1>

        <form action="/posts" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required
                       value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" name="file">
                <p class="help-block">Example block-level help text here.</p>
            </div>

            {{--<div class="form-group">--}}
                {{--<label for="body">Body:</label>--}}
                {{--<textarea name="body" id="body" class="form-control" required--}}
                          {{--rows="8">{{ old('body') }}--}}
                                {{--</textarea>--}}
            {{--</div>--}}

            <input id="trix" type="hidden" name="body">
            <trix-editor input="trix"></trix-editor>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
            </div>
        </form>

    </div>
@endsection
