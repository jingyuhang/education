@extends('layouts.app')
@section('title','课程公告修改')
@section('content')
@include('public.left')
    <div class="form-inline">

        <select name="course_id" class="c_id form-control" id="" style="width: auto;">
            @foreach($notice_info as $v)
                @foreach($course_info as $vv)
                    <option class="course_id" value="{{$vv->course_id}}" @if($vv->course_id == $v->course_id) selected @endif>{{$vv->course_name}} </option>
                @endforeach
        </select>
    </div>
    <div class="form-inline">

        课程公告：<input type="text" value="{{$v->notice}}" class="form-control notice" style="width: auto" name="notice" id="">

        <input type="hidden" name="notice_id" class="notice_id" value="{{$v->notice_id}}">

        <input type="button" value="修改公告" class="notice_update">
    </div>
            @endforeach

    <script>
//        var c_id='';
//        $(document).on("change",".c_id",function () {
//            c_id=$(this).val();
//            alert(c_id);
//        });


        $(document).on("click",".notice_update",function () {
            var notice=$(".notice").val();
            var notice_id=$(".notice_id").val();
            var course_id=$(".c_id").val();
            var url="{{asset('NoticeController/noticeupdate')}}";

//        alert('课程'+course_id);
//        alert(notice_id);return;
            $.ajax({
                url:url,
                data: { course_id: course_id,notice:notice,notice_id:notice_id},
                type: 'post',
                dataType: 'json',
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
            var msg=confirm('课程公告修改成功，是否返回课程公告列表');
            if(msg==true){
                window.location.href="{{url('NoticeController/notice_show_view')}}";
            }else{
                window.history.go(0);
            }
        }

    </script>
@endsection