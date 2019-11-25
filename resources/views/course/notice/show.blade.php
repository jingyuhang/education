@extends('layouts.app')
@section('title','课程公告展示')
@section('content')
@include('public.left')
<a href="{{ url('NoticeController/create_notice_view') }}" class="layui-btn">添加公告</a>
        <form action="{{url('/NoticeController/notice_show_view')}}" method="get">
            <div class="form-inline">
            公告内容：<input type="text" name="notice" id="" value="">
            课程：<select name="course_id" class="c_id form-control" id="" style="width: auto;">
                    <option value="">请选择课程</option>

                @foreach($course_notice as $v)
                    <option class="course_id" value="{{$v['course_id']}}">{{$v['course_name']}}</option>
                @endforeach
            </select>
            <input type="submit" value="搜索">
            </div>
        </form>


    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>课程公告ID</td>
            <td>课程名称</td>
            <td>课程公告内容</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        @foreach($course_notice as $v)
            <tr>
                <td>{{$v['notice_id']}}</td>
                <td>{{$v['course_name']}}</td>
                <td>{{$v['notice']}}</td>
                <td>{{date("Y-m-d H:i:s",$v['create_time'])}}</td>
                <td>
                    <a href="{{url('/NoticeController/notice_update_view',['notice_id'=>$v['notice_id']])}}">修改</a>
                    <a href="{{url('/NoticeController/noticedel',['notice_id'=>$v['notice_id']])}}">删除</a>
                </td>
            </tr>
        @endforeach

    </table>

    {{ $course_notice->links() }}

    <script>

    </script>

@endsection