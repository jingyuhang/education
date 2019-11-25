@extends('layouts.app')
@section('title','导航展示')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
<a href="{{ url('naviga/naviga_add') }}" class="layui-btn">添加导航</a>
<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>ID</th>
      <th>导航名称</th>
      <th>导航地址</th>
      <th>操作</th>
    </tr>
    @foreach($data as $v)
    	
    <tr>
      <th>{{$v->navigation_id}}</th>
      <th>{{$v->navigation_name}}</th>
      <th>{{$v->navigation_url}}</th>
      <th>
      	<a class="layui-btn layui-btn-xs edit" lay-event="edit" href="javascript:;" navigation_id="{{$v->navigation_id}}">编辑</a>
  		<a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-xs delte" lay-event="del" navigation_id="{{$v->navigation_id}}">删除</a>
      </th>
    </tr>
    @endforeach
  </thead>

</table>
  
</div>
<script src="/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).on('click','.delte',function(){
		var navigation_id = $(this).attr("navigation_id");
		// console.log(lect_id);
		$.ajax({
        url:'http://www.edublog.com/naviga/naviga_del',
        type:"DELETE",
        data:{navigation_id:navigation_id},
        dataType:"json",
        success:function(res){
        	if(res.code == 200){
        		alert(res.msg);
        		location.href="http://www.edublog.com/naviga/naviga_list";
        	}else{
        		alert(res.msg);
        		location.href="http://www.edublog.com/naviga/naviga_list";
        	} 	
        	}
    	})
	})

	$(document).on('click','.edit',function(){
		var navigation_id = $(this).attr("navigation_id");
		location.href="http://www.edublog.com/naviga/naviga_edit?navigation_id="+navigation_id;
	})

</script>
@endsection