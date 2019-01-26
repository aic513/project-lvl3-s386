@extends('layouts.main')

@section('content')
    <table class='table table-hover table-bordered'>
        <thead class="thead-light">
        <tr>
            <th scope="col">id</th>
            <th scope="col">domain</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($domains as $domain)
            <tr>
                <th scope="row">{{ $domain->id }}</th>
                <td>@if($isSingleRow)
                        {{ $domain->name }}
                    @else
                        <a href={{ route('domains.show', ['id' => $domain->id]) }}>{{ $domain->name }}</a>
                    @endif
                </td>
                <td>{{ $domain->created_at }}</td>
                <td>{{ $domain->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(!$isSingleRow)
        {{ $domains->links('paginator.custom', ['paginator' => @domains]) }}
    @else
        <div class="container">
            <ul class="list-group text-center">
                <li class="list-group-item">Response Code <b>{{ empty($domains[0]->response_code) ? '-' :  $domains[0]->response_code }}</b></li>
                <li class="list-group-item">Content length <b>{{ empty($domains[0]->content_length) ? '-' :  $domains[0]->content_length}}</b></li>
            </ul>
        </div>
    @endif
@endsection
