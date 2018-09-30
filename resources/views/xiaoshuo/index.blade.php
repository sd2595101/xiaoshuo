@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form name="f-search" action="/query" method="get" class="col-md-10">
            <div class="form-row">
                <div class="keyword-input">
                    <i class="fa fa-search"></i>
                    <input type="text" name="q" value="" class="form-control p-2" autofocus="true" placeholder="请输入书名进行检索" />
                </div>
            </div>
        </form>
    </div>
</div>
@endsection