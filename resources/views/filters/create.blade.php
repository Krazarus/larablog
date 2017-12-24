@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a new Filter:</h1>

        <form action="/filters" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Publish</button>
                <a class="btn btn-default" href="/filters">Cancel</a>
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
