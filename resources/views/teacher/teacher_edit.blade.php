@extends('layouts.app')
@section('title','讲师修改')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
        <div class="page-content">
            <div class="content">

                <form class="layui-form" id="f">
                    @foreach($teaData as $v)
                    <div class="layui-form-item">
                        <label class="layui-form-label">讲师修改</label>
                        <div class="layui-inline">
                            
                            <input type="text" name="lect_name" lay-verify="title" autocomplete="off" class="layui-input" value="{{$v['lect_name']}}">

                        </div>
                    </div>

                    <div class="layui-form-item">

                        <label for="exampleInputFile" class="layui-form-label">上传图片</label>
                        <div class="layui-inline">
                        <input type="file" id="file" name="image">
                        </div>
                        <br>
                        <img src="" id="img_show" width="100">
                    </div>

                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">讲师简介</label>
                        <div class="layui-input-block">
                          <textarea class="layui-textarea" name="lect_resume" value="{{$v['lect_resume']}}"></textarea>
                        </div>
                     </div>
                    
                     <div class="layui-form-item">
                        <label class="layui-form-label">授课风格</label>
                        <div class="layui-inline">
                            <input type="text" name="lect_style" lay-verify="title" autocomplete="off" value="{{$v['lect_style']}}" class="layui-input">
                        </div>
                    </div>
                    @endforeach
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">分类级别</label>
                            <div class="layui-input-inline">
                                <select name="pid" id="pid">
                                    <option value="">选择课程</option>
                                    @foreach($cateData as $v)
                                    <optgroup>
                                        <option value="{{$v['cate_id']}}" selected>{{str_repeat('--',$v['level'])}}{{$v['cate_name']}}</option>
                                    </optgroup>
                               
                                    @endforeach
                                </select>
                            </div>
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
            var lect_id = getQueryString("lect_id");
            var base64Str;
            $('#file').on('change',function(){
                var image = $('[name="image"]')[0].files[0]; //获取到文件
                var reader = new FileReader(); //h5 
                reader.readAsDataURL(image);//读base编码后的URL地址
                reader.onload = function()
                {
                    base64Str = this.result;
                    $("#img_show").attr('src',this.result);
                }
            })
         $(document).on('click','#btn',function(){
            var lect_name = $("[name = lect_name]").val();
            var lect_resume = $("[name = lect_resume]").val();
            var lect_style = $("[name = lect_style]").val();
            var cate_id = $.trim($('#pid option:selected').attr('value'));
            console.log(base64Str);
            // console.log(lect_name);
            $.ajax({
                url:"/teacher/teacher/update",
                type:"POST",
                data:{lect_id:lect_id,lect_name:lect_name,lect_resume:lect_resume,lect_style:lect_style,cate_id:cate_id,image:base64Str},
                dataType:"json",
                success:function(res){
                    alert(res.msg);
                    location.href="http://www.edublog.com/teacher/teacher";
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