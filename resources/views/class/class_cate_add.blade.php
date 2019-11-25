@extends('layouts.app')
@section('title','课程分类添加')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
        <div class="page-content">
            <div class="content">

                <form class="layui-form" onsubmit="false" id="f">

                    <div class="layui-form-item">
                        <label class="layui-form-label">课程分类</label>
                        <div class="layui-inline">
                            <input type="text" name="cate_name" lay-verify="title" autocomplete="off" placeholder="请输入标题" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">分类级别</label>
                            <div class="layui-input-inline">
                                <select name="pid">
                                    <option value="">顶级分类</option>
                                    <optgroup label="顶级分类">
                                        <option value="0" selected>顶级分类</option>
                                    </optgroup>
                                    <optgroup label="顶级分类名">
                                        @foreach($p_category as $p_category)
                                            <option value="{{$p_category['cate_id']}}">{{$p_category['cate_name']}}</option>
                                        @endforeach
                                    </optgroup>
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
            $(function(){
                $("#btn").click(function(){
                    var form = document.getElementById("f");
                    var formdata = new FormData(form);
                    var cate_name = formdata.get("cate_name");
                    var pid = formdata.get("pid");
                   // console.log(cate_name);
                    $.ajax({
                        url:"/class/class_cate_add_do",
                        date:{cate_name:cate_name,pid:pid},
                        type:"POST",
                        dataType:"JSON",
                        success:function(res){
                            console.log(res);

                        }

                    })
                })
            })
        </script>
@endsection