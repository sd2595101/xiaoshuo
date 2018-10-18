@extends('layouts.app')

@section('content')

<div class="container">
  <nav aria-label="breadcrumb-bravo">
    <ol class="breadcrumb-bravo">
      <li class="breadcrumb-item-bravo"><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
      <li class="breadcrumb-item-bravo"><a href="/query?q={{$book['category_name']}}" target="_blank">{{$book['category_name']}}</a></li>
      <li class="breadcrumb-item-bravo"><a href="{{route('book', $book['bookid'])}}">{{$book['title']}}</a></li>
      <li class="breadcrumb-item-bravo active">最新章节</li>
    </ol>
  </nav>
  <div class="row center">
    <div class="col">
      <h1 class="m-2 text-danger">{{$book['title']}}</h1>
    </div>
  </div>
  <div class="row center">
    <div class="col">
      <span>作者&nbsp;：&nbsp;{{$book['uname']}}</span>
    </div>
  </div>
  <div class="container">
    @foreach ($list as $group)
    <div class="container  chapter-container tomename">
      <div class="col"><h3>{{$group['volume']}}</h3></div>
    </div>
    <ul class="chapter-list">
      @foreach ($group['chapter-list'] as $chapter)
      <?php 
          $chapterId = $chapter['chapterid'];
          $isVip = in_array($chapterId, $group['chapter-list-vip']);
      ?>
      <li class="col-4 {{ $isVip ? 'vip' : '' }}">
        
        <a href="{{ route('content', [$book['bookid'], $chapter['chapterid']]) }}">
          @if ($isVip ==true)
        <span class="glyphicon glyphicon-star"></span>
        @endif{{$chapter['chaptername']}}
        </a>
      </li>
      @endforeach
    </ul>
    @endforeach
  </div>
</div>
@endsection