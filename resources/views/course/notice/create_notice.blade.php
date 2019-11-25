@extends('layouts.app')
@section('title','课程公告添加')
@section('content')
@include('public.left')
    <div class="form-inline">
        <select name="course_id" class="c_id form-control" id="" style="width: auto;">
            @foreach($course_info as $v)
                <option class="course_id" value="{{$v['course_id']}}">{{$v['course_name']}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-inline">
        课程公告：<input type="text" class="form-control notice" style="width: auto" name="notice" id="">

        <input type="button" value="添加公告" class="notice_add">
    </div>


    <script>
        var c_id='';
        $(document).on("change",".c_id",function () {
            c_id=$(this).val();
//            alert(c_id);
        });

        $(document).on("click",".notice_add",function () {
            var notice=$(".notice").val();
            var course_id=c_id;
            var url="{{asset('NoticeController/create_notice')}}";

//        alert('课程'+course_id);
//        alert(notice);
            $.ajax({
                url:url,
                data: { course_id: course_id,notice:notice},
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if(res.code==1){
                        alert(res.msg);
////                        alert(1);
////                        var course_id=res.course_id;
////                        var u_id=res.u_id;
//                        wjl_confirm();

                    }else{
                        alert(res.msg);
                    }
                }
            })

        });
        //确定取消框
        function wjl_confirm(){
            var msg=confirm('收藏成功，是否返回课程列表');
            if(msg==true){
                window.location.href="{{url('CollectController/select_course')}}";
            }else{

            }
        }

    </script>
@endsection