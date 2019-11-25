@extends('layouts.app')
@section('content')
@include('public.left')
    <form>
        <div class="form-inline">
            <label for="favoritepleInputEmail1" ><b style="font-size: 18px;color: blue">收藏夹名称</b></label>
            <input type="text"  name="favorite_name" class="form-control favorite_name"  placeholder="收藏夹指导标题" style="width: auto">
        </div>

        <input type="hidden" name="user_id" class="user_id" value="{{$user_id}}">
        <input type="hidden" name="course_id" class="course_id" value="{{$course_id}}">
        <input type="button" value="添加收藏夹" class="favorite_add form-group">
    </form>
    <script>

        $(document).on("click",".favorite_add",function () {
            var user_id=$("input.user_id").val();
            var course_id=$("input.course_id").val();
            var favorite_name=$("input.favorite_name").val();
            var url="{{asset('CollectController/create_favorite')}}";
//            alert($user_id);return;
            $.ajax({
                url:url,
                data: {user_id: user_id, course_id: course_id,favorite_name:favorite_name},
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if(res.code==1){
//                        alert(res.msg);
//                        alert(1);
                        var course_id=res.course_id;
//                        var u_id=res.u_id;
                        wjl_confirm(course_id,user_id);
                        location.href="http://www.edublog.com/CollectController/favorite_list"
                    }else{
                        alert(res.msg);
                    }
                }
            })

        });
        //确定取消框
        function wjl_confirm(course_id,user_id){
            var msg=confirm('添加收藏夹成功是否继续将本课程加入收藏');
            var $course_id=course_id;
//            alert(course_id);
//            var $u_id=u_id;
            if(msg==true){
                window.location.href="{{url('CollectController/create_collect_view',['course_id'=>$course_id,'user_id'=>$user_id])}}";
            }else{
                window.location.href(-1);
            }
        }

    </script>
@endsection()