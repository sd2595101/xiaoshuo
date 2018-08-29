<?php
$bodyClass = ' home h100';
$homeactive = 'active';
/*$headerCssAdd = 'mb-auto';*/
$headerCssAdd = 'mb-auto-home';
?>

@extends('layouts.xiaoshuo')

@section('main')
<main role="main" class="inner cover cover-up">
  <form action="/query" method="get">
      <input type="text" name="q" value="" class="form-control p-2" autofocus="true" placeholder="请输入书名按回车键进行检索" />
  </form>
</main>
@endsection