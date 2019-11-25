@extends('layouts.app')
@section('title','用户详情')
@section('content')
@include('public.left')
<center>
<h1>个人中心</h1>
<a href="{{ url('user/useradd') }}" class="layui-btn">添加用户</a>
    <table class="table table-bordered table-hover table-striped" border="1">
        <tr align="center">
            <td>用户编码</td>
            <td>用户名称</td>
            <td>用户邮箱</td>
            <td>用户头像</td>
            <td>年龄</td>
            <td>性别</td>
            <td>状态</td>
            <td>注册时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr u_id="{{$v->u_id}}">
                <td>{{$v->u_id}}</td>
                <td>{{$v->u_name}}</td>
                <td>{{$v->u_email}}</td>
                <td><img src="{{asset($v->u_head)}}" width="50"></td>
                <td>{{$v->u_age}}</td>
                <td>
                     @if(($v->u_sex)==1)
                        男
                    @else
                        女
                    @endif
                </td>
                <td>
                    @if($v->ustatus==1)
                        <span style="color:red;" class="frame" ustatus="{{$v->ustatus}}" u_id="{{$v->u_id}}">禁用</span>
                    @else
                        <span style="color:green;" class="frame" ustatus="{{$v->ustatus}}" u_id="{{$v->u_id}}">启用</span>
                    @endif
                </td>
                <td>{{ date('Y-m-d H:i:s',$v->u_time) }}</td>
                <td>
                    <a href="{{url('user/usercollect')}}?u_id={{$v->u_id}}" class="btn btn-danger">用户收藏</a>
                    <a href="{{url('user/userorder')}}?u_id={{$v->u_id}}" class="btn btn-primary">订单详情</a>
                    <a href="{{url('teacher_examine')}}?u_head={{$v->u_head}}&u_name={{$v->u_name}}&u_id={{$v->u_id}}" class="btn btn-danger">提升为讲师</a>
                </td>
            </tr>
        @endforeach
    </table>
</center>
<script>
$(document).on('click','.frame',function(){
            // alert(111);
            var u_id = $(this).attr('u_id');
            // alert(u_id);
            var ustatus = $(this).attr('ustatus');
            if(ustatus==2){
                ustatus = 1;
            }else{
                ustatus = 2;
            }
            $.ajax({
                url:"http://www.edublog.com/user/useron",
                data:{ustatus:ustatus,u_id:u_id},
                type:"POST",
                dataType:"json",
                success:function(res){
                    if(res.code==1){
                        alert(res.msg);
                        location.href="http://www.edublog.com/user/userlist";
                    }else{
                        alert(res.msg);
                        location.href="http://www.edublog.com/user/userlist";
                    }
                }
            })
        });
</script>
@endsection