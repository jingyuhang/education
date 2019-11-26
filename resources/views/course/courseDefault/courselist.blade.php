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
                <td> <input type="checkbox" name="course_id_arr" id="" value="{{$v->course_id}}">{{$v->course_id}}</td>
                <td class="lect_id" lect_id="{{$v->lect_id}}">{{$v->course_name}}</td>
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
                <td class="u_id" u_id="{{$_SESSION['user_id']}}">{{$v->course_total}}</td>
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
    <div>
        <input class="layui-btn" type="button" value="购买" id="buy">
    </div>
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
    $(document).on('click',"#buy",function () {
        // alert(1);
        var u_id=$(".u_id").attr('u_id');
        var lect_id =$(".lect_id").attr('lect_id');
        //jquery获取复选框值
        var course_id_array =[];//定义一个数组
        $('input[name="course_id_arr"]:checked').each(function(){//遍历每一个名字为interest的复选框，其中选中的执行函数
            course_id_array.push($(this).val());//将选中的值添加到数组course_id_array中
        });
        window.location.href="http://www.edublog.com/OrderController/order_pay?u_id="+u_id+"&lect_id="+lect_id+"&course_id_array="+course_id_array;
        // $.ajax({
        //     url:"{{url('/OrderController/order_pay')}}",
        //     data: {course_id_array:course_id_array, u_id:u_id,lect_id:lect_id},
        //     type: 'post',
        //     dataType: 'json',
        //     success: function (res) {
        //         console.log(res);
        //     }
        // })
})
</script>
@endsection