@extends('layouts.app')

@section('content')
<div class="container-fluid ">
    <div class="row justify-content-center index-box">
        <form name="f-search" action="/query" method="get" class="col-md-10">
            <div class="form-row">
                <div class="keyword-input">
                    <i class="fa fa-search"></i>
                    <span class="fa glyphicon glyphicon-search"></span>
                    <input type="text" name="q" value="" class="form-control p-2" autofocus="true" placeholder="请输入关键字搜书" />
                </div>
            </div>
        </form>
    </div>
</div>
@endsection