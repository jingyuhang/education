@extends('layouts.app')
@section('content')
@include('public.left')
    <?php
        session_start();
        $_SESSION['u_id']='1';
    ?>
    <div class="form-inline">
        课程选择：
        <select name="course_id" class="c_id form-control" id="" style="width: auto;">
            <option value="">请选择您的课程</option>
            @foreach($course_info as $v)
                <option class="course_id" value="{{$v['course_id']}}">{{$v['course_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-inline">
        支付方式：
        <select name="course_id" class="p_id form-control" id="" style="width: auto;">
            <option value="">请选择支付方式</option>
            @foreach($pay_info as $vv)
                <option class="course_id" value="{{$vv['pay_id']}}">{{$vv['pay_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-inline">

        支付状态：
        <select name="pay_status" class="pay_status form-control" id="" style="width: auto;">
            <option value="">请选择支付状态</option>
            <option class="" value="1">未支付</option>
            <option class="" value="2">已支付</option>
            <option class="" value="3">取消支付</option>
        </select>

    </div>
    <div class="form-group">
        订单编号：<input type="text" class="form-control order_mark" style="width: auto" name="order_mark" id="">
        支付金额：<input type="text" class="form-control pay_price" style="width: auto" name="pay_price" id="">


        <input type="hidden" name="u_id" class="u_id" value="{{$_SESSION['u_id']}}">
        <input type="button" value="添加订单" class="order_add">
    </div>


    <script>
//        var c_id='';
//        $(document).on("change",".c_id",function () {
//            c_id=$(this).val();
////            alert(c_id);
//        });



        $(document).on("click",".order_add",function () {
//            var order=$(".order").val();
            var course_id=$(".c_id").val();
            var p_id=$(".p_id").val();
            var u_id=$(".u_id").val();
            var pay_status=$(".pay_status").val();
            var order_mark=$(".order_mark").val();
            var pay_price=$(".pay_price").val();
//            alert(pay_price);return;
            var url="{{asset('OrderController/create_order')}}";

//        alert('课程'+course_id);
//        alert(order);

            $.ajax({
                url:url,
                data: { course_id: course_id,p_id:p_id,u_id:u_id,pay_status:pay_status,order_mark:order_mark,pay_price:pay_price},
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if(res.code==1){
//                        console.log(res);
                     var  order_id=res.order_id;
                        wjl_confirm(order_id,u_id);
                    }else{
                        alert(res.msg);
                    }
                }
            })

        });
        //确定取消框
        function wjl_confirm(order_id,u_id){
            var msg=confirm('订单添加成功，是否继续添加订单详情');
            var order_id=order_id;
            var u_id=u_id;
            if(msg==true){
                window.location.href="http://www.edublog.com/OrderController/create_detail_view?order_id="+order_id+'&u_id='+u_id;
            }else{

            }
        }

    </script>
@endsection