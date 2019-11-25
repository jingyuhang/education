@extends('layouts.app')
@section('title','笔记展示')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
    <center>
    <h3>笔记列表</h3>
    </center>
    <br>
    <a href="{{url('course/note/create')}}" class="btn btn-warning">添加笔记</a>
    <br>
    <center>
    <table class="layui-table table-bordered table-hover table-striped" border="1">

    <tr>
        <td>编码</td>
        <td>课程名称</td>
        <td>笔记内容</td>
        <td>加入时间</td>
        <td>操作</td>
    </tr>
    @foreach($data as $k=>$v)
        <tr>

                <td>{{$v->note_id}}</td>
                <td>{{$v->course_name}}</td>
                <td>{{$v->note_desc}}</td>
                <td>{{date('Y-m-d h:i:s',$v->create_time)}}</td>
                <td>
                    <a href="{{url('course/note/del')}}?id={{$v->note_id}}" class="btn btn-danger">删除</a>
                </td>
        </tr>
    @endforeach
    </table>
</center>
@endsection