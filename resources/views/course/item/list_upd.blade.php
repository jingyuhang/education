@extends('layouts.app')
@section('content')
@include('public.left')

    <form  action="/admin/ltem/bank_add" method="post">

        <span>单选题</span><br/>
        <input type="hidden" name="type_id" value="1">
        题目：<input type="text" name="problem" value="{{$data[0]['problem']}}"><br/>
        {{--@foreach ($data as $k=>$v)--}}
        <input type="radio" name="single_answer"  value="1">
        <input type="text" name="single_a" placeholder="{{$data[0]['answer']}}" value=""><br/>
        {{--@endforeach--}}
        <input type="hidden" class="is_yes" value="{{$data[0]['is_answer']}}">
        <input type="radio" name="single_answer"  value="2">
        <input type="text" name="single_a" placeholder="{{$data[1]['answer']}}" value=""><br/>
        <input type="radio" name="single_answer"  value="3">
        <input type="text" name="single_a" placeholder="{{$data[2]['answer']}}" value=""><br/>
        <input type="radio" name="single_answer"  value="4">
        <input type="text" name="single_a" placeholder="{{$data[3]['answer']}}" value=""><br/>
        <input type="submit" name="sub" value="提交">
    </form>

    <script>
        var is_yes= $('.is_yes').val();
//        alert(is_yes);
        $("input[value="+is_yes+"]").attr("checked",'checked');
    </script>
@endsection











