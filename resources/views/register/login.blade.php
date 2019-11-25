@extends('layouts.admin')
@section('content')
<h3>登录</h3>
    <div class="form-group">
        <label for="exampleInputEmail1">邮箱</label>
        <input type="email" class="form-control" name="u_email" id="u_email">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">密码</label>
        <input type="password" class="form-control" name="u_pwd" id="u_pwd">
    </div>
    <button class="btn">登录</button>
<script type="text/javascript">
    $(document).on('click','.btn',function(){
        var u_email = $.trim($("#u_email").val());
        var u_pwd = $.trim($("#u_pwd").val());
        $.ajax({
            url:"http://www.edublog.com/user/login",
            type:'POST',
            data:{u_email:u_email,u_pwd:u_pwd},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    // alert(1);
                    alert(res.msg);
                    location.href='/user/login_do';
                }
            }
        })
    })
</script>
@endsection