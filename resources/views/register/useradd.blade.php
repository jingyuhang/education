@extends('layouts.admin')
@section('content')
<h3>登录</h3>
<form action="{{url('user/userdoadd')}}" method="POST" enctype="multipart/form-data" id='form'>
    <div class="form-group">
        <label for="exampleInputEmail1">用户名称</label>
        <input type="text" class="form-control" name="u_name" id="u_name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">邮箱</label>
        <input type="email" class="form-control" name="u_email" id="u_email">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">密码</label>
        <input type="password" class="form-control" name="u_pwd" id="u_pwd">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">头像</label>
        <input type="file" class="form-control" name="u_head" id="u_head">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">年龄</label>
        <input type="text" class="form-control" name="u_age" id="u_age">
    </div>
    <div class="form-group">
    <label for="exampleInputEmail1">性别</label>
    <input type="radio" name="u_sex" id='u_sex' value="1" checked="">男
    <input type="radio" name="u_sex" id='u_sex' value="2">女</br>
    </div>
    <button class="btn">添加用户</button>
</form>
<script>
    $(document).on('change','#u_email',function(){
        var u_email = $.trim($("#u_email").val());
        $.ajax({
            url:"http://www.edublog.com/user/seluser",
            type:'POST',
            data:{u_email:u_email},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    console.log(res.msg);
                    return false;
                }else{
                    console.log(res.msg);
                }
            }
        })
    })
</script>
@endsection