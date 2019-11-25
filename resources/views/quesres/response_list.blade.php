@extends('layouts.app')
@section('title','问题答复展示')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
<a href="{{ url('quesres/response/create') }}" class="layui-btn">添加答复</a>
<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>问题编号</th>
      <th>学生用户名</th>
      <th>所属课程</th>
      <th>问题标题</th>
      <th>问题内容</th>
      <th>提问时间</th>
      <th>回复答案</th>
      <th>回复时间</th>
      <th>操作</th>
    </tr>
    @foreach($quesData as $v)
      
    <tr>
    
      <th>{{$v->q_id}}</th>
      <th>{{$v->u_email}}</th>
      <th>{{$v->course_name}}</th>
      <th>{{$v->q_title}}</th>
      <th>{{$v->q_content}}</th>
      <th>{{date("Y-m-d H:i:s",$v->q_time)}}</th>
      <th>{{$v->r_content}}</th>
      <th>{{date("Y-m-d H:i:s",$v->r_time)}}</th>
      <th>
        <a class="layui-btn layui-btn-xs edit" lay-event="edit" href="javascript:;" r_id="{{$v->r_id}}">修改答案</a>
      <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs delte" lay-event="del" r_id="{{$v->r_id}}">删除答案</a>
      </th>
      
      
    </tr>
    
    @endforeach
  </thead>
</table>

</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.delte',function(){
    var r_id = $(this).attr("r_id");
    console.log(r_id);
    $.ajax({
        url:'http://www.edublog.com/quesres/response/delete',
        type:"DELETE",
        data:{r_id:r_id},
        dataType:"json",
        success:function(res){
          if(res.code == 200){
            alert(res.msg);
            location.href="http://www.edublog.com/quesres/response";
          }else{
            alert(res.msg);
            location.href="http://www.edublog.com/quesres/response";
          }   
          }
      })
  })

  $(document).on('click','.edit',function(){
    var r_id = $(this).attr("r_id");
    location.href="http://www.edublog.com/quesres/response/edit?r_id="+r_id;
  })
</script>
@endsection