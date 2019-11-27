@extends('layouts.app')
@section('title','试卷展示')
@section('content')
@include('public.left')
<a href="{{ url('test/create') }}" class="layui-btn">添加试卷</a>
    <form action="{{url('/TestController/test_show')}}" method="get">
        <div class="form-inline">
            题型选择：
            <select name="type_id" id="">
                <option value="">请选择题型</option>
                <option value="1">单选</option>
                <option value="2">多选</option>
                <option value="3">判断</option>
            </select>
        </div>
        <input type="submit" value="搜索" class="btn btn-success">
    </form>


    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>试卷ID</td>
            <td>试卷名称</td>
            <td>试卷种类</td>
            <td>操作</td>
        </tr>
        @foreach($test_info as $v)
            <tr>
                <td>{{$v->test_id}}</td>
                <td>{{$v->test_name}}</td>
                <td>@if($v->type_id==1)单选 @elseif($v->type_id==2) 多选 @else 判断 @endif</td>

                <td>
                    <a class="btn btn-info" href="{{url('/TestController/test_del',['test_id'=>$v->test_id])}}">删除</a>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $test_info->appends(['type_id' => $type_id])->links() }}

@endsection