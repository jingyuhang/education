@extends('layouts.app')
@section('title','评论列表展示')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')

<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>评论用户名</th>
      <th>所属课程</th>
      <th>评论内容</th>
      <th>点赞数</th>
      <th>评论时间</th>
      <th>操作</th>
    </tr>
    @foreach($evaData as $v)
      
    <tr>
      <th>{{$v->u_email}}</th>
      <th>{{$v->course_name}}</th>
      <th>{{$v->evaluate_desc}}</th>
      <th>{{$v->evaluate_num}}</th>
      <th>{{date("Y-m-d H:i:s",$v->create_time)}}</th>
      <th>
        <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs delte" lay-event="del" evaluate_id="{{$v->evaluate_id}}">删除评论</a>
      </th>
    </tr>
    @endforeach
  </thead>
</table>

</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).on('click','.delte',function(){
    var evaluate_id = $(this).attr("evaluate_id");
    console.log(evaluate_id);
    $.ajax({
        url:'http://www.edublog.com/evaluate/course/delete',
        type:"DELETE",
        data:{evaluate_id:evaluate_id},
        dataType:"json",
        success:function(res){
          if(res.code == 200){
            alert(res.msg);
            location.href="http://www.edublog.com/evaluate/course";
          }else{
            alert(res.msg);
            location.href="http://www.edublog.com/evaluate/course";
          }   
          }
      })
  })

</script>
@endsection