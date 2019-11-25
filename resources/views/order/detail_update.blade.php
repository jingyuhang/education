@extends('layouts.app')
@section('title','导航添加')
@section('content')
@include('public.left')
    <form>
        @foreach($detail_info as $vv)
        <div class="form-inline">
            课程选择：
            <select name="course_id" class="c_id form-control" id="" style="width: auto;">
                <option value="">请选择您的课程</option>
                @foreach($course_info as $v)
                    <option class="course_id" value="{{$v['course_id']}}" @if($vv->course_id==$v['course_id']) selected @endif>{{$v['course_name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-inline">
            讲师选择：
            <select name="course_id" class="lect_id form-control" id="" style="width: auto;">
                <option value="">请选择您的讲师</option>
                @foreach($teacher_info as $v)
                    <option class="course_id" value="{{$v['lect_id']}}" @if($vv->lect_id==$v['lect_id']) selected @endif>{{$v['lect_name']}}</option>
                @endforeach
            </select>
        </div>

        <div class="form-inline">
            <label for="exampleInputEmail1" ><b style="font-size: 18px;color: blue">订单详情视频</b></label>


            <input type="file" name="file" id='file'>
            <video width="200px" height="200px" src="{{url($vv->video)}}" id='img_show' style="width: 300px;"></video>
        </div>


        <div class="form-group">
            <label for="exampleInputEmail1" ><b style="font-size: 18px;color: blue">是否免费</b></label>
            免费：<input type="radio" name="is_free" id="" value="1" @if($vv->is_free==1) checked @endif>
            收费：<input type="radio" name="is_free" id="" value="2" @if($vv->is_free==2) checked @endif>

        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" ><b style="font-size: 18px;color: blue">课程价格</b></label>
            <input type="number" name="course_price" value="{{$vv->course_price}}" class="course_price" id="">
        </div>

            <input type="hidden" name="detail_id" class="detail_id" value="{{$vv->detail_id}}">
        <input type="button" value="修改订单详情" class="detail_add form-group">
        @endforeach
    </form>

    {{--上传图片--}}

    <script type="text/javascript">
        //全局定义
        var base64Str;
        $("#file").on('change',function(){
            //模拟表单对象  FormData
            var file = $('[name="file"]')[0].files[0]; //获取到文件
            var reader = new FileReader(); //h5
            reader.readAsDataURL(file); //读base编码后的url地址
            reader.onload = function()
            {
                base64Str = this.result;
                //console.log(this.result);
                $("#img_show").attr('src',this.result);
            }
        });

    </script>
    {{--添加操作--}}
    <script>

        $(document).on("click",".detail_add",function () {
            var fd= new FormData();
            var course_id=$(".c_id").val();
            var lect_id=$(".lect_id").val();
            var course_price=$(".course_price").val();
            var detail_id=$(".detail_id").val();
            var detail_photo=$("#file")[0].files[0];
            var is_free=$('input[type=radio][name=is_free]:checked').val();


            var url="{{asset('OrderController/detail_update')}}";

            fd.append('course_id',course_id);
            fd.append('lect_id',lect_id);
            fd.append('course_price',course_price);
            fd.append('detail_id',detail_id);
            fd.append('detail_photo',detail_photo);
            fd.append('is_free',is_free);

            $.ajax({
                url:url,
                data:fd,
                type: 'post',
                dataType: 'json',
                contentType:false,
                processData:false,
                success: function (res) {
                    console.log(res);
                    if(res.code==1){
//
                        wjl_confirm();
                    }else{
                        alert(res.msg);
                        window.history.go(-1);
                    }
                }
            })

        });

        //确定取消框
        function wjl_confirm(){
            var msg=confirm('订单详情修改成功，是否返回订单列表');
            if(msg==true){
                window.location.href="{{url('OrderController/order_show')}}";
            }else{
                window.history.go(0);
            }
        }


    </script>
@endsection()