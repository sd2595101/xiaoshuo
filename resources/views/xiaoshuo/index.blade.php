@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form name="f-search" action="/query" method="get" class="col-md-10">
            <div class="form-row">
                <div class="col-md-10">
                    <input type="text" name="q" value="" class="form-control p-2" autofocus="true" placeholder="请输入书名进行检索" />
                </div>
                <div class="col-md-2">
                    <a class="btn btn-link" href="javascript:void(0);" onclick="document.forms['f-search'].submit();"><i class="fas fa-search"></i> 搜索</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection