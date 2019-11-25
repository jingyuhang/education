@extends('layouts.app')
@section('content')
@include('public.left')
    <form  action="/admin/ltem/warm_add" method="post">
        <input type="hidden" name="type_id" value="3">
        <span>判断</span>
        <br/>
        题目：<input type="text" name="judge" value="{{$data[0]['problem']}}"><br/>
        对:<input type="radio" name="judge_answer" value="1">
        <input type="hidden" class="is_yes" value="{{$data[0]['is_answer']}}">

        错:<input type="radio" name="judge_answer" value="2">
        <input type="submit" name="sub" value="提交">
    </form>

    <script>
        var is_yes= $('.is_yes').val();
        //        alert(is_yes);
        $("input[value="+is_yes+"]").attr("checked",'checked');
    </script>
@endsection











