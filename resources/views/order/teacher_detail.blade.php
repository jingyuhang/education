@extends('layouts.app')
@section('title','导航添加')
@section('content')
@include('public.left')
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>讲师ID</td>
            <td>讲师名称</td>
            <td>讲师简介</td>
            <td>授课风格</td>
        </tr>
        @foreach($lecturer_info as $v)
            <tr>
                <td>{{$v->lect_id}}</td>
                <td>{{$v->lect_name}}</td>
                <td>{{$v->lect_resume}}</td>
                <td>{{$v->lect_style}}</td>
            </tr>
        @endforeach

    </table>

    <script>

    </script>

@endsection