@extends('layouts.app')
@section('content')
@include('public.left')
<div class="form-inline">
    <select name="favorite_id" class="f_id form-control" id="" style="width: auto;">
        @foreach($favorite_info as $v)
            <option class="favorite_id" value="{{$v['favorite_id']}}">{{$v['favorite_name']}}</option>
        @endforeach
    </select>

    <a class="form-control" style="width: auto;" href="{{url('CollectController/create_favorite_view_1',['user_id'=>$user_id,'course_id'=>$course_id])}}">添加新的收藏夹</a>
    <input type="hidden" name="u_id" class="u_id" value="{{$user_id}}">
    <input type="hidden" name="course_id" class="course_id" value="{{$course_id}}">
    <input type="button" value="确定" class="collect_add">
</div>

<script>
//    var f_id='';
//    $(document).on("change",".f_id",function () {
//        f_id=$(this).val();
////            alert(f_id);
//    });

    $(document).on("click",".collect_add",function () {
        var course_id=$("input.course_id").val();
        var u_id=$("input.u_id").val();
        var favorite_id=$(".f_id").val();
        var url="{{asset('CollectController/create_collect')}}";

//        alert('课程'+course_id);
//        alert('用户'+u_id);
//        alert('收藏夹'+favorite_id);
        $.ajax({
            url:url,
            data: {u_id: u_id, course_id: course_id,favorite_id:favorite_id},
            type: 'post',
            dataType: 'json',
            success: function (res) {
                console.log(res);
                if(res.code==1){
//                        alert(res.msg);
////                        alert(1);
////                        var course_id=res.course_id;
////                        var u_id=res.u_id;
                    wjl_confirm();

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
    //获取url中的参数
    function getUrlParam(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
        var r = window.location.search.substr(1).match(reg);  //匹配目标参数
        if (r != null) return unescape(r[2]); return null; //返回参数值
    }


</script>
@endsection