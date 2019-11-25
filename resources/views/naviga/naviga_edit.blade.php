@extends('layouts.app')
@section('title','讲师修改')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
        <div class="page-content">
            <div class="content">

                <form class="layui-form" id="f">
                    @foreach($data as $v)
                    <div class="layui-form-item">
                        <label class="layui-form-label">导航修改</label>
                        <div class="layui-inline">
                            
                            <input type="text" name="navigation_name" lay-verify="title" autocomplete="off" class="layui-input" value="{{$v->navigation_name}}">

                        </div>
                    </div>

                     <div class="layui-form-item">
                        <label class="layui-form-label">url地址</label>
                        <div class="layui-inline">
                            <input type="text" name="navigation_url" lay-verify="title" autocomplete="off" value="{{$v->navigation_url}}" class="layui-input">
                        </div>
                    </div>
                    @endforeach
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
            var navigation_id = getQueryString("navigation_id");
           
	         $(document).on('click','#btn',function(){
	            var navigation_name = $("[name = navigation_name]").val();
	            var navigation_url = $("[name = navigation_url]").val();
	            $.ajax({
	                url:"http://www.edublog.com/naviga/naviga_edit_do",
	                type:"POST",
	                data:{navigation_id:navigation_id,navigation_name:navigation_name,navigation_url:navigation_url},
	                dataType:"json",
	                success:function(res){
	                    alert(res.msg);
	                    location.href="http://www.edublog.com/naviga/naviga_list";
	                }
	            })
	         })

	         function getQueryString(name) {
	        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
	        var r = window.location.search.substr(1).match(reg);
	        if (r != null) return unescape(r[2]); return null;
	    }
        </script>
@endsection