@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>All filters:</h2>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary pull-right">Create new filter</button>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-10 col-xs-offset-1 col-md-10">
                @foreach($filters as $filter)
                    <div class="row">
                        <div class="col-md-6 col-xs-6">{{ $filter->name }}</div>
                        <div class="col-md-6 col-xs-6">
                            <form action="/filters/{{ $filter->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-primary">Edit</button>
                                <button type="submit" class="btn btn-danger">Destroy</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="flash alert alert-{{ session('class') }} alert-dismissible" role="alert">
            {{ session('flash') }}
        </div>
    </div>
@endsection