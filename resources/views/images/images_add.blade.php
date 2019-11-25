@extends('layouts.app')
@section('title','商品轮播图')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
        <div class="page-content">
            <div class="content">

                <form class="layui-form" id="f">

					<div class="layui-form-item">

	                    <label for="exampleInputFile" class="layui-form-label">商品轮播图</label>
	                    <div class="layui-inline">
	                    <input type="file" id="file" name="images">
	                    </div>
	                    <br>
	                    <img src="" id="img_show" width="100">
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
            var num = parseInt(0);
            // console.log(num);
        	var base64Str;
		    $('#file').on('change',function(){
		        var images = $('[name="images"]')[0].files[0]; //获取到文件
		        var reader = new FileReader(); //h5 
		        reader.readAsDataURL(images);//读base编码后的URL地址
		        reader.onload = function()
		        {
		            base64Str = this.result;
		            $("#img_show").attr('src',this.result);
		        }
		    })
         $(document).on('click','#btn',function(){
         	$.ajax({
         		url:"http://www.edublog.com/images/images_add_do",
				type:"POST",
	            data:{images:base64Str,num:num},
	            dataType:"json",
	            success:function(res){
	            	alert(res.msg);
	            	location.href="http://www.edublog.com/images/images_list";
				}
         	})
         })
        </script>
@endsection