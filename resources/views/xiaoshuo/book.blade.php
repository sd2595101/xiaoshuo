<?php 
$bodyClass = ' h100';
$pageTitle = $book['title'] . '最新章节全文阅读,' . $book['title'].'无弹窗，' . $book['uname'].'的小说';
?>
@extends('layouts.xiaoshuo')

@section('main')
<div class="container book">
    <div class="row">
      <div class="col-5 col-sm-4 col-md-3 col-lg-3 ">
        <div class="p-2">
          <a href="/xiaoshuo/chapter/{{$book['bookid']}}.html">
            <img src="{{$book['image']}}" class="inner" style="width:100%;"/>
          </a>
        </div>
      </div>
      <div class="col-7 col-sm-8 col-md-9 col-lg-9 ">
        <div class="p-2">
          <div class="row">
            <span class="h1">
              <a href="/xiaoshuo/chapter/{{$book['bookid']}}.html">{{$book['title']}}</a>
            </span>
            <a href="/xiaoshuo/chapter/{{$book['bookid']}}.html" class="p-1 m-1 text-right text-info" target="_blank">
             [ <i class="fab fa-readme"></i> 章节列表 ] </a>
          </div>
          <div class="row">
            <a href="{{$book['ulink']}}" class="p-1 font-weight-light" target="_blank">{{$book['uname']}}</a>
            <span class="p-1 font-weight-light"> | </span>
            <a href="{{$book['clink']}}" class="p-1 font-weight-light" target="_blank">{{$book['cname']}}</a>
            <span class="p-1 font-weight-light text-muted" style="font-size:14px"> | 关键字 : {{$book['keyword']}}</span>
          </div>
          <div class="description text-left text-secondary">
            {{$book['desc']}}<br/><br/>
            <span class="text-muted">
              觉得《{{$book['title']}}》还不错的话请不要忘记向您QQ群和微博里的朋友推荐哦！
            </span>
            <br/>
            <a href="{{$book['ulink']}}" target="_blank">点击这里查看<span class="text-primary">《{{$book['uname']}}》的更多神作！<span class="text-muted"></a>
            
          </div>
        </div>
      </div>
    </div>
</div>


@endsection