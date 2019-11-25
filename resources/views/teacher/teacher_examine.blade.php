@extends('layouts.app')
@section('title','教师审核')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>申请人</th>
      <th>申请课程</th>
      <th>申请时间</th>
      <th>操作</th>
    </tr>
    @foreach($teaData as $v)
      
    <tr>
      <th class="u_name" u_name="{{$u_name}}" u_id="{{$u_id}}">{{$v['u_email']}}</th>
      <th class="u_head" u_head="{{$u_head}}" cate_name="{{$v['cate_name']}}">{{$v['cate_name']}}</th>
      <th>{{date("Y-m-d H:i:s",time())}}</th>
      <th><a class="layui-btn layui-btn-xs edit" lay-event="edit" href="javascript:;" lect_id="{{$v['lect_id']}}">通过</a>
      <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs delte" lay-event="del" lect_id="{{$v['lect_id']}}">拒绝</a></th>
    </tr>
    @endforeach
  </thead>
</table>
<script type="text/javascript">
$(document).on('click','.edit',function(){
            var lect_id = $(this).attr("lect_id");
            var u_head = $(".u_head").attr("u_head");
            var u_name = $(".u_name").attr('u_name');
            var u_id = $(".u_name").attr('u_id');
            var cate_name = $(".u_head").attr('cate_name');
            $.ajax({
                url:"{{url('teacher_examine_do')}}",
                type:"POST",
                data:{lect_id:lect_id,u_head:u_head,u_name:u_name,cate_name:cate_name,u_id:u_id},
                dataType:"json",
                success:function(res){
                    alert(res.msg);
                    location.href="http://www.edublog.com/teacher/teacher";
                }
            })
         })

$(document).on('click','.delte',function(){
            var lect_id = $(this).attr("lect_id");
            $.ajax({
                url:"{{url('teacher_examine_del')}}",
                type:"POST",
                data:{lect_id:lect_id},
                dataType:"json",
                success:function(res){
                    alert(res.msg);
                    location.href="http://www.edublog.com/teacher/teacher";
                }
            })
         })


</script>
@endsection