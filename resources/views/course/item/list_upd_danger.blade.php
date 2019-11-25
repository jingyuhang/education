@extends('layouts.app')
@section('content')
@include('public.left')

    <form  action="/admin/ltem/danger_add" method="post">
        <input type="hidden" name="type_id" value="2">
        <span>多选</span><br/>
            <input type="hidden" class="is_yes" value="{{$is_yes}}">
        题目：<input type="text" name="problem"  value="{{$data[0]['problem']}}"><br/>
        A:<input type="checkbox" name="single_answer[]"  value="1">
        <input type="text" name="single_a" placeholder="{{$data[0]['answer']}}"><br/>
        B:<input type="checkbox" name="single_answer[]"value="2">
        <input type="text" name="single_b"  placeholder="{{$data[1]['answer']}}" ><br/>
        C:<input type="checkbox" name="single_answer[]"  value="3">
        <input type="text" name="single_c" placeholder="{{$data[2]['answer']}}"><br/>
        D:<input type="checkbox" name="single_answer[]"  value="4">
        <input type="text" name="single_d" placeholder="{{$data[3]['answer']}}"><br/>
        <input type="submit" name="sub" value="提交">
    </form>
    <script>

        var is_yes= $(".is_yes").val();
//                alert(is_yes);
        var arr=new Array();
        arr=is_yes.split(',');
        for(var i=0;i<arr.length;i++)
        {
            $("input[value="+arr[i]+"]").attr("checked",'checked');
        }


    </script>
@endsection











