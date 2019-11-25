@extends('layouts.app')
@section('title','导航添加')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
        <div class="page-content">
            <div class="content">

                <form class="layui-form" id="f">

                    <div class="layui-form-item">
                        <label class="layui-form-label">导航添加</label>
                        <div class="layui-inline">
                            <input type="text" name="navigation_name" lay-verify="title" autocomplete="off" placeholder="请添加导航" class="layui-input">
                        </div>
                    </div>

                     <div class="layui-form-item">
                        <label class="layui-form-label">url地址</label>
                        <div class="layui-inline">
                            <input type="text" name="navigation_url" lay-verify="title" autocomplete="off" placeholder="请添加地址" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <input type="button" id="btn" value="立即提交">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="/js/jquery.min.js"></script>
        <script>
         $(document).on('click','#btn',function(){
         	var navigation_name = $("[name = navigation_name]").val();
			var navigation_url = $("[name = navigation_url]").val();
         	$.ajax({
         		url:"http://www.edublog.com/naviga/naviga_add_do",
				type:"POST",
	            data:{navigation_name:navigation_name,navigation_url:navigation_url},
	            dataType:"json",
	            success:function(res){
	            	alert(res.msg);
	            	location.href="http://www.edublog.com/naviga/naviga_list";
				}
         	})
         })
        </script>
@endsection