@extends('layouts.app')
@section('title','问题修改')
@section('content')
<div class="wrapper">
    <!--左侧导航开始-->
@include('public.left')
    <div class="page-content">
        <div class="content">

            <form class="layui-form" id="f">
            	
                    <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">问题回复</label>
                    @foreach($resData as $v)
                    <div class="layui-input-block">
                      <textarea placeholder="{{$v['r_content']}}" class="layui-textarea" name="r_content"></textarea>
                    </div>
                    @endforeach
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
   	var url = "http://www.edublog.com/quesres/response/update";
	var r_id = getQueryString("r_id");
	console.log(r_id);
    $.ajax({
	url:"http://www.edublog.com/quesres/response/edit",
    type:"get",
    data:{r_id:r_id},
    dataType:"json",
    success:function(res){
    	console.log(res);
    }
})

$("#btn").on('click',function(){
	var r_content = $(".layui-textarea").val();
	// consloe.log(lect_style);
	$.ajax({
        url:url,
        type:"POST",
        data:{r_id:r_id,r_content:r_content},
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