@extends('layouts.main')

@section('content')
    <div class="jumbotron" align="center">
        <form action="{{route('domains.store')}}" method="post">
            <div class="form-group">
                <div class="col-5">
                    <label for="exampleInputUrl">Enter URL and press Submit</label>
                    <input type="url" name="url" class="form-control" id="exampleInputUrl" placeholder="Enter url">
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm" value="Submit">Submit</button>
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
