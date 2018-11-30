@extends('layouts.globalLayout');

@section('content')
    <div class="jumbotron">
        <h3> Create Post </h3>
        <div class="form-group">
            <form action="/post/store">
                <p>
                    <label for="title"> Title: </label>
                    <input type="text" class="form-control" id="title">
                </p>
                <p>
                    <label for="Body"> Body: </label>
                    <input type="text" class="form-control" id="body">
                </p>
                <p>
                    <input class="btn btn-dark" type="button" value="Submit">
                </p>
            </form>
        </div>
    </div>
@endsection