@extends('layouts.app')
@section('title','讲师列表')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
<a href="{{ url('teacher/teacher/create') }}" class="layui-btn">添加讲师</a>
<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>ID</th>
      <th>讲师姓名</th>
      <th>讲师照片</th>
      <th>讲师简介</th>
      <th>授课风格</th>
      <th>负责课程</th>
      <th>操作</th>
    </tr>
    @foreach($teaData as $v)
    	
    <tr>
      <th>{{$v['lect_id']}}</th>
      <th>{{$v['lect_name']}}</th>
      <th><img src="{{asset($v['image'])}}" width="50"></th>
      <th>{{$v['lect_resume']}}</th>
      <th>{{$v['lect_style']}}</th>
      <th>{{$v['cate_name']}}</th>
      <th>
      	<a class="layui-btn layui-btn-xs edit" lay-event="edit" href="javascript:;" lect_id="{{$v['lect_id']}}">编辑</a>
  		<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs delte" lay-event="del" lect_id="{{$v['lect_id']}}">删除</a>
      <a class="btn btn-danger" href="{{url('teacher/teacher/profit')}}?lect_id={{$v['lect_id']}}">讲师收益</a>
      </th>
    </tr>
    @endforeach
  </thead>

</table>
  {{$teaData -> links()}}
</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).on('click','.delte',function(){
		var lect_id = $(this).attr("lect_id");
		// console.log(lect_id);
		$.ajax({
        url:'http://www.edublog.com/teacher/teacher/delete',
        type:"DELETE",
        data:{lect_id:lect_id},
        dataType:"json",
        success:function(res){
            if(res.code == 200){
              alert(res.msg);
              location.href="http://www.edublog.com/teacher/teacher";
            }	
        	}
    	})
	})

	$(document).on('click','.edit',function(){
		var lect_id = $(this).attr("lect_id");
		location.href="http://www.edublog.com/teacher/teacher/edit?lect_id="+lect_id;
	})

</script>
@endsection