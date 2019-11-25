@extends('layouts.app')
@section('content')
@include('public.left')
    <form>
        <div class="form-inline">
            <label for="collectpleInputEmail1" ><b style="font-size: 18px;color: blue">收藏夹名称</b></label>

            <select name="favorite_id" class="f_id" id="">
                @foreach($favorite_info as $v)
                <option class="favorite_id" value="{{$v['favorite_id']}}">{{$v['favorite_name']}}</option>
                @endforeach
            </select>

            <input type="hidden" name="u_id" class="u_id" value="{{$u_id}}">
            <input type="hidden" name="course_id" class="course_id" value="{{$course_id}}">
        </div>
        <input type="button" value="添加收藏" class="collect_add form-group">
    </form>
    <script>
//        var f_id='';
//        $(document).on("change",".f_id",function () {
//            f_id=$(this).val();
////            alert(f_id);
//        });

        $(document).on("click",".collect_add",function () {
            var course_id=$("input.course_id").val();
            var u_id=$("input.u_id").val();
            var favorite_id=$(".f_id").val();
            var url="{{asset('CollectController/create_collect')}}";

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
                window.location.href="{{url('course/course')}}";
            }else{
                window.location.href(-1);
            }
        }

    </script>
@endsection()