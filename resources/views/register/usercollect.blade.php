@extends('layouts.app')
@section('title','用户收藏')
@section('content')
@include('public.left')
<h1>个人中心</h1>
<center>
    <table class="table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>收藏夹名称</td>
            <td>课程名称</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr>
                <td>{{$v->favorite_name}}</td>
                <td>{{$v->course_name}}</td>
            </tr>
        @endforeach
    </table>
</center>
@endsection