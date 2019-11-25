@extends('layouts.app')
@section('title','笔记添加')
@section('content')
@include('public.left')
<div>

    <h3>欢迎注册 在线教育管理员</h3>

    <form class="layui-form" action = "{{url('course/note/store')}}" method = "post">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">课程</label>
            <div class="layui-input-inline" style="z-index: 9999;">
            <select name="course_id" lay-verify="required">
                <option value=""></option>
                <option value="0">php</option>
                <option value="1">python</option>
                <option value="2">java</option>
                <option value="3">c++</option>
            </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">笔记内容</label>
            <div class="layui-input-inline" style="width: 500px;">
                <textarea  name="note_desc" id="goods_intro"></textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="submit" class="layui-btn add" lay-submit lay-filter="formDemo" value="添加笔记">
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="{{asset('/ueditor/ueditor.config.js')}}"></script>
<script type="text/javascript" src="{{asset('/ueditor/ueditor.all.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
<script type="text/javascript">
    var ue = UE.getEditor('goods_intro');
</script>
@endsection