@extends('layouts.app')
@section('title','问题添加')
@section('content')
<div class="wrapper">
    <!--左侧导航开始-->
@include('public.left')
    <div class="page-content">
        <div class="content">

            <form class="layui-form" id="f">
            		<div class="layui-form-item">
                        <label class="layui-form-label">问题标题</label>
                        <div class="layui-inline">
                            <input type="text" name="q_title" lay-verify="title" autocomplete="off" placeholder="请添加问题标题" class="layui-input">
                        </div>
                    </div>

                   <div class="layui-form-item layui-form-text">
					    <label class="layui-form-label">问题内容</label>
					    <div class="layui-input-block">
					      <textarea placeholder="请输入问题内容" class="layui-textarea" name="q_content"></textarea>
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
var course_id = getQueryString("course_id");
$("#btn").on('click',function(){
	var q_title = $("[name = q_title]").val();
	var q_content = $(".layui-textarea").val();
	// consloe.log(q_content);
	$.ajax({
        url:"http://www.luang.com/quesres/add_do",
        type:"POST",
        data:{q_title:q_title,q_content:q_content,course_id:course_id},
        dataType:"json",
        success:function(res){
        	if(res.code == 200){
        		alert(res.msg);
            	location.href="http://www.luang.com/quesres/list";
        	}else{
        		alert(res.msg);
            	location.href="http://www.luang.com/quesres/list";
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