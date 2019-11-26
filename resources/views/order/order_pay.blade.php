@extends('layouts.app')
@section('content')
@include('public.left')
    <?php
        session_start();
        $_SESSION['u_id']='1';
    ?>
    <form>
        <div class="form-inline">
            支付方式：
            <select name="p_id" class="p_id form-control" id="" style="width: auto;">
                <option value="">请选择支付方式</option>
                @foreach($pay_info as $vv)
                    <option class="course_id" value="{{$vv['pay_id']}}">{{$vv['pay_name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" name="u_id" class="u_id" value="{{$_SESSION['u_id']}}">
            <input type="button" value="添加订单" class="order_add">
        </div>
    </form>
    <script>
    $(document).on("click",".order_add",function () {
            var p_id=$(".p_id").val();
            var u_id=$(".u_id").val();
            var lect_id=$(".lect_id").val();
            var url="{{asset('OrderController/create_order_and_detail')}}";
            $.ajax({
                url:url,
                data: {p_id:p_id,u_id:u_id},
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if(res.code==200){
                       location.href="http://www.edublog.com/OrderController/order_show";
                    }else{
                        alert(res.msg);
                    }
                }
            })

        });
</script>
@endsection