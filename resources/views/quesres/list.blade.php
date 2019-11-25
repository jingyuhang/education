@extends('layouts.app')
@section('title','问题展示')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')

<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>问题编号</th>
      <th>学生用户名</th>
      <th>所属课程</th>
      <th>问题标题</th>
      <th>问题内容</th>
      <th>浏览量</th>
      <th>问题时间</th>
      <th>操作</th>
    </tr>
    @foreach($quesData as $v)
      
    <tr>
    
      <th>{{$v->q_id}}</th>
      <th>{{$v->u_email}}</th>
      <th>{{$v->course_name}}</th>
      <th>{{$v->q_title}}</th>
      <th>{{$v->q_content}}</th>
      <th>{{$v->q_browse}}</th>
      <th>{{date("Y-m-d H:i:s",$v->q_time)}}</th>
      <th>
        <a class="layui-btn layui-btn-xs response" lay-event="edit" href="javascript:;" q_id="{{$v->q_id}}">回答问题</a>
      <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs delte" lay-event="del" q_id="{{$v->q_id}}">删除问题</a>
      </th>
      
      
    </tr>
    
    @endforeach
  </thead>
</table>

</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.delte',function(){
    var q_id = $(this).attr("q_id");
    console.log(q_id);
    // return false;
    $.ajax({
        url:'http://www.edublog.com/quesres/question/delete',
        type:"DELETE",
        data:{q_id:q_id},
        dataType:"json",
        success:function(res){
          if(res.code == 200){
            alert(res.msg);
            location.href="http://www.edublog.com/quesres/question";
          }else{
            alert(res.msg);
            location.href="http://www.edublog.com/quesres/question";
          }   
          }
      })
  })

  $(document).on('click','.response',function(){
    var q_id = $(this).attr("q_id");
    location.href="http://www.edublog.com/quesres/response/create?q_id="+q_id;
  })
</script>
@endsection