@extends('layouts.app')

@section('content')

<div class="container">
    <nav aria-label="breadcrumb-bravo">
      <ol class="breadcrumb-bravo">
        <li class="breadcrumb-item-bravo"><a href="#"><i class="fa fa-coffee"></i></a></li>
        <li class="breadcrumb-item-bravo"><a href="/query?q={{$book['category_name']}}" target="_blank">{{$book['category_name']}}</a></li>
        <li class="breadcrumb-item-bravo"><a href="{{route('book', $book['bookid'])}}">{{$book['title']}}</a></li>
        <li class="breadcrumb-item-bravo"><a href="{{route('chapter', $book['bookid'])}}">最新章节</a></li>
        <li class="breadcrumb-item-bravo active" aria-current="page">{{$info['volume']}}</li>
      </ol>
    </nav>
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