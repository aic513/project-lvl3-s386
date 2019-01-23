@extends('layouts.main')

@section('home', 'active')

@section('content')
    <div class="jumbotron jumbotron-fluid" align="center">
        <div class="container">
            <p class="lead">Write URL and press enter</p>
            <hr class="my-4">
            <form action="/domains" method="post">
                <input type="text" name="url">
                <input class="btn btn-primary" type="submit" value="Enter">
            </form>
        </div>
    </div>
@endsection