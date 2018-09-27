<?php 
$pageTitle = $book['title'] . '最新章节全文阅读,' . $book['title'].'无弹窗，' . $book['uname'].'的小说';
?>
@extends('layouts.xiaoshuo')

@section('main')

<div class="row">
  <div class="col">
    <h1 class="m-2 text-danger">{{$book['title']}}</h1>
    
  </div>
</div>
<div class="row">
  <div class="col">
    <span>{{$book['uname']}}</span>
  </div>
</div>
<div class="container">
@foreach ($list as $group)
  <div class="container  chapter-container tomename">
    <div class="col"><h3>{{$group['volume']}}</h3></div>
  </div>
  <!-- 
  <div class="container border-top chapter-container">
  @foreach ($group['chapter-list'] as $chapter)
    <a href="/xiaoshuo/chapter/{{$book['bookid']}}/{{$chapter['chapterid']}}.html"><div class="chapter-col text-info pt-1">{{$chapter['chaptername']}}</div></a>
  @endforeach
  </div>
   -->
  <ul class="chapter-list">
  @foreach ($group['chapter-list'] as $chapter)
    <li class="col-4">
      <a href="/xiaoshuo/chapter/{{$book['bookid']}}/{{$chapter['chapterid']}}.html">
        {{$chapter['chaptername']}}
      </a>
    </li>
  @endforeach
  </ul>
@endforeach
</div>
@endsection