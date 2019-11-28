@extends('layouts.app')
@section('title','课程展示')
@section('content')
@include('public.left')
<center>
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>活动名称</td>
            <td>活动内容</td>
            <td>课程价格</td>
            <td>参与后价格</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v->activity_title}}</td>
                <td>{{$v->activity_content}}</td>
                @foreach($res as $k=>$vv)
                <td>{{$vv->course_price}}</td>
                <td>{{$c_price}}</td>
                @endforeach
            </tr>
        @endforeach
    </table>
</center>
@endsection
