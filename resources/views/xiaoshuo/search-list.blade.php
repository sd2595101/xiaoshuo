@extends('layouts.app')

@section('content')
<div class="container">
    @foreach ($booklist as $book)
    <div class="row border-bottom list">
        <div class="col-5 col-sm-4 col-md-3 col-lg-2 ">
            <div class="p-2">
                <img src="{{$book['image']}}" class="inner" style="width:100%;"/>
            </div>
        </div>
        <div class="col-7 col-sm-8 col-md-9 col-lg-9 ">
            <div class="p-2">
                <div class="row">
                    <span class="h1">
                        <a href="/xiaoshuo/book/{{$book['bookid']}}.html">{{$book['title']}}</a>
                    </span>
                </div>
                <div class="row">
                    <a href="{{$book['ulink']}}" class="p-1 font-weight-light" target="_blank">{{$book['uname']}}</a>
                    <span class="p-1 font-weight-light"> | </span>
                    <a href="{{$book['clink']}}" class="p-1 font-weight-light" target="_blank">{{$book['cname']}}</a>
                    <span class="p-1 font-weight-light text-muted" style="font-size:14px"> | 关键字 : {{implode(' | ',$book['keyword'])}}</span>
                </div>
                <div class="description text-left">
                    {{$book['desc']}}
                </div>
                <div class="list-btn-area">
                    <div>
                        <a href="/xiaoshuo/book/{{$book['bookid']}}.html" class="p-1 m-1 text-right text-danger" >
                            [ <i class="fab fa-readme"></i> 查看书页 ] </a>
                    </div>
                    <div>
                        <a href="/xiaoshuo/chapter/{{$book['bookid']}}.html" class="p-1 m-1 text-right text-danger" >
                            [ <i class="fab fa-readme"></i> 最新章节 ] </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection