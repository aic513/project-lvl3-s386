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
        <tr>
            <th scope="row">{{ $domain->id }}</th>
            <td>{{ $domain->name }}</td>
            <td>{{ $domain->created_at }}</td>
            <td>{{ $domain->updated_at }}</td>
        </tr>
        </tbody>
    </table>
    <div class="container">
        <ul class="list-group text-center">
            <li class="list-group-item"><b>Response code</b> {{ empty($domain->response_code) ? 'is empty' :  $domain->response_code }}</li>
            <li class="list-group-item"><b>Content length</b> {{ empty($domain->content_length) ? 'is empty' :  $domain->content_length}}</li>
            <li class="list-group-item"><b>Header of page:</b> {{ empty($domain->main_header) ? 'is empty' :  $domain->main_header}}</li>
            <li class="list-group-item"><b>Keywords:</b> {{ empty($domain->meta_keywords) ? 'is empty' :  $domain->meta_keywords}}</li>
            <li class="list-group-item"><b>Description:</b> {{ empty($domain->meta_description) ? 'is empty' :  $domain->meta_keywords}}</li>
        </ul>
    </div>
@endsection
