@extends('layouts.app')
@section('title','问题回答')
@section('content')
<div class="wrapper">
    <!--左侧导航开始-->
@include('public.left')
    <div class="page-content">
        <div class="content">

            <form class="layui-form" id="f">
            	
                    <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">问题回复</label>
                    <div class="layui-input-inline"  style="width: 500px;">
                      <textarea  name="r_content" id="myEditor"></textarea>
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
    <script type="text/javascript" src="{{asset('/ueditor/ueditor.config.js')}}"></script>
	<script type="text/javascript" src="{{asset('/ueditor/ueditor.all.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <script src="/js/jquery.min.js"></script>
    <script>
    var ue = UE.getEditor('myEditor');
   	var url = "http://www.edublog.com/quesres/response/store";
	var q_id = getQueryString("q_id");
	console.log(q_id);
$("#btn").on('click',function(){
	var r_content = $("[name=r_content]").val();
    console.log(r_content);
	// consloe.log(lect_style);
	$.ajax({
        url:url,
        type:"POST",
        data:{q_id:q_id,r_content:r_content},
        dataType:"json",
        success:function(res){
        	if(res.code == 200){
        		alert(res.msg);
            	location.href="http://www.edublog.com/quesres/response";
        	}else{
        		alert(res.msg);
            	location.href="http://www.edublog.com/quesres/question";
        	}
        }
    });
})

	function getQueryString(name) {
		var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
		var r = window.location.search.substr(1).match(reg);
		if (r != null) return unescape(r[2]); return null;
	}
    </script>
@endsection