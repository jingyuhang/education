@extends('layouts.app')
@section('title','课程展示')
@section('content')
@include('public.left')

<?php
    session_start();
    $_SESSION["user_id"]="1";
?>
<center>
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>课程编码</td>
            <td>课程名称</td>
            <td>分类名称</td>
            <td>授课状态</td>
            <td>总课时</td>
            <td>学习人数</td>
            <td>标题图</td>
            <td>课程介绍</td>
            <td>是否免费</td>
            <td>课程价格</td>
            <td>创建时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr course_id="{{$v->course_id}}">
                <td>{{$v->course_id}}</td>
                <td>{{$v->course_name}}</td>
                <td>{{$v->cate_name}}</td>
                <td>
                    @if(($v->course_status)==1)
                        未开始
                    @elseif(($v->course_status)==2)
                        正在授课
                    @else
                        授课完毕
                    @endif
                </td>
                <td>{{$v->course_total}}</td>
                <td>{{$v->already_study_num}}</td>
                <td><img src="{{asset($v->title_picture)}}" width="50"></td>
                <td>{{$v->intro}}</td>
                <td>{{$v->is_free}}</td>
                <td>￥{{$v->course_price}}</td>
                <td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
                <td><a href="javascript:;" class="del btn btn-danger">删除</a>
                <a href="{{url('course/course/courseedit')}}?course_id={{$v->course_id}}" class="btn btn-danger">修改</a>
                <a href="{{url('course/part')}}?course_id={{$v->course_id}}" class="btn btn-danger">查看章节</a>
                <a href="{{url('course/job')}}?course_id={{$v->course_id}}" class="btn btn-danger">查看作业</a>
                <a href="{{url('course/note')}}?course_id={{$v->course_id}}" class="btn btn-danger">查看笔记</a>
                <a href="{{url('evaluate/course')}}?course_id={{$v->course_id}}" class="btn btn-danger">查看评价</a>
                <a href="{{url('NoticeController/notice_show_view')}}?course_id={{$v->course_id}}" class="btn btn-danger">查看公告</a>
                </td>
            </tr>
        @endforeach
    </table>
</center>
<script>
    $(document).on('click','.del',function(){
        var course_id=$(this).parents('tr').attr('course_id');
        // alert(course_id);
        $.ajax({
            url:"http://www.edublog.com/course/course/coursedel",
            type:'POST',
            data:{course_id:course_id},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/course';
                }
            }
        })
    })
</script>
@endsection