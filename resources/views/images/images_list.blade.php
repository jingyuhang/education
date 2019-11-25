@extends('layouts.app')
@section('title','轮播图列表')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
<a href="{{ url('images/images_add') }}" class="layui-btn">添加导航图</a>
<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>ID</th>
      <th>轮播图缩略图</th>
      <th>操作</th>
    </tr>
    @foreach($imgData as $v)
    	
    <tr>
      <th>{{$v->img_id}}</th>
      <th><img src="{{$v->images}}" width="50"></th>
      <th>
      	<a class="layui-btn layui-btn-xs edit" lay-event="edit" href="javascript:;" img_id="{{$v->img_id}}">编辑</a>
  		<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs delte" lay-event="del" img_id="{{$v->img_id}}">删除</a>
      </th>
    </tr>
    @endforeach
  </thead>

</table>

</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).on('click','.delte',function(){
		var img_id = $(this).attr("img_id");
		// console.log(lect_id);
		$.ajax({
        url:'http://www.edublog.com/images/images_del',
        type:"DELETE",
        data:{img_id:img_id},
        dataType:"json",
        success:function(res){
        	if(res.code == 200){
        		alert(res.msg);
        		location.href="http://www.edublog.com/images/images_list";
        	}else{
        		alert(res.msg);
        		location.href="http://www.edublog.com/images/images_list";
        	} 	
        	}
    	})
	})

	$(document).on('click','.edit',function(){
		var img_id = $(this).attr("img_id");
		location.href="http://www.edublog.com/images/images_edit?img_id="+img_id;
	})

</script>
@endsection