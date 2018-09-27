<?php 
$pageTitle = $book['title'] . ' ' . $info['title'].' ' . $book['uname'].'的小说';
?>
@extends('layouts.xiaoshuo')

@section('main')

<div class="row">
  <div class="col">
    <h1 class="m-2 text-danger">{{$info['title']}}</h1>
    
  </div>
</div>
<div class="row">
  <div class="col">
    <span>{{$book['uname']}}</span>
  </div>
</div>
<div class="container">
  <div class="content">
  @foreach ($info['content'] as $content)
    <p>{{$content}}</p>
  @endforeach
  </div>
@endsection