@extends('layouts.app')
@section('title','作业展示')
@section('content')
@include('public.left')
<a href="{{url('/course/job/create')}}" class="btn btn-primary">添加作业</a>
    <h2>作业列表</h2>
    <table class="layui-table table-bordered table table-striped table-condensed">
        <tr align="center">
            <td>作业ID</td>
            <td>作业名称</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
           <?php $time = date("Y-m-d H:i:s",$v['create_time'])?>
            <tr align="center">
                <td>{{$v['job_id']}}</td>
                <td>{{$v['job_name']}}</td>
                <td>{{date("Y-m-d H:i:s",$v['create_time'])}}</td>
                <td><a href="{{url('course/job/update')}}?id={{$v['job_id']}}" class="btn btn-danger">编辑</a>
                    |
                    <a href="{{url('course/job/delete')}}?id={{$v['job_id']}}" class="btn btn-primary">删除</a>
                </td>

            </tr>
        @endforeach
        <tr>
        <td colspan="6"> {{$data->links()}}</td>
        </tr>
    </table>
@endsection