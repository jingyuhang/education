@extends('layouts.app')
@section('title','课程分类添加')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
    <h3>权限 管理员列表</h3>
    <br>
    <a href="{{url('adminRight/adminAdd')}}" class="btn btn-warning">添加管理员</a>
    <br>
    <center>
    <table class="layui-table table-bordered table-hover table-striped" border="1">

    <tr>
        <td>编码</td>
        <td>管理员姓名</td>
        <td>电话</td>
        <td>邮箱</td>
        <td>加入时间</td>
        <td>操作</td>
    </tr>
    @foreach($data as $k=>$v)
        <tr>

                <td>{{$v->admin_id}}</td>
                <td>{{$v->admin_name}}</td>
                <td>{{$v->mobile}}</td>
                <td>{{$v->email}}</td>
                <td>{{date('Y-m-d h:i:s',$v->create_time)}}</td>
                <td>
                    <a href="{{url('del')}}?id={{$v->admin_id}}" class="btn btn-danger">删除</a>
                    <a href="{{url('edit')}}?id={{$v->admin_id}}" class="btn btn-warning">修改</a>
                    <a href="{{url('adminRight/permissionCreate')}}?id={{$v->admin_id}}" class="btn btn-warning">分配权限</a>
                </td>
        </tr>
    @endforeach
    </table>
</center>
@endsection