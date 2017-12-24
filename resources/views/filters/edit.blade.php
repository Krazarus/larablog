@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit filter:</h1>

        <form action="/filters/{{ $filter->id }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="form-group">
                <label for="title">Name filter:</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="{{ $filter->name }}">
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
