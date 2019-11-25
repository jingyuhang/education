@extends('layouts.app')
@section('title','课程分类添加')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
<div>

    <h3>欢迎注册 在线教育管理员</h3>

    <form class="layui-form">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="admin_name" required  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
                <input type="text" name="mobile" required  lay-verify="required" placeholder="请输入电话" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="email" name="email" required  lay-verify="required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="password" name="password" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="button" class="layui-btn add" lay-submit lay-filter="formDemo" value="注册">
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    $(document).on('click','.add',function(){
        var admin_name = $("[name = 'admin_name']").val();
        var mobile = $("[name = 'mobile']").val();
        var email = $("[name = 'email']").val();
        var password = $("[name = 'password']").val();
        $.ajax({
            url:"{{url('adminRight/adminAddDo')}}",
            data:{admin_name:admin_name,mobile:mobile,email:email,password:password},
            type:"POST",
            dataType:"json",
            success:function(res){
                alert(res.msg);
                if(res.code == 200){
                    location.href = "http://www.edublog.com/adminRight/adminList";
                }
            }
        })
    })
</script>
@endsection