<?php
$bodyClass = ' home h100';
$homeactive = 'active';
/*$headerCssAdd = 'mb-auto';*/
$headerCssAdd = 'mb-auto-home';
?>

@extends('layouts.xiaoshuo')

@section('main')
<main role="main" class="inner cover cover-up mx-auto">
  <form name="f-search" action="/query" method="get" class="">
  <div class="form-row">
    <div class="form-group col-md-10 col-sm-8  col-xs-6 col-12">
      <input type="text" name="q" value="" class="form-control p-2" autofocus="true" placeholder="请输入书名进行检索" />
    </div>
    <a class="btn btn-link" href="javascript:void(0);" onclick="document.forms['f-search'].submit();"><i class="fas fa-search"></i> 搜索</a>
  </div>
  </form>
</main>
@endsection