@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row center">
        <div class="col">
            <h1 class="m-2">{{$info['title']}}</h1>
        </div>
    </div>
    <div class="container">
        <div class="content">
            @foreach ($info['content'] as $content)
            <p>{{$content}}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection