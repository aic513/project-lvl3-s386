@extends('layouts.main')

@section('content')
    <div class="jumbotron" align="center">
        <p class="lead">Enter URL and press submit</p>
        <hr class="my-4">
        <form action={{ route('domains.store') }} method="post">
            <input type="text" name="url">
            <input class="btn btn-primary" type="submit" value="Submit">
        </form>
        @isset($errors)
            @foreach ($errors as $error)
                @component('layouts.alert')
                    {{ $error }}
                @endcomponent
            @endforeach
        @endisset
    </div>
@endsection
