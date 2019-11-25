@extends('layouts.app')
@section('content')
@include('public.left')
    <div class="form-inline">

        <select name="course_id" class="c_id form-control" id="" style="width: auto;">
            @foreach($collect_info as $v)
                @foreach($course_info as $vv)
                    <option class="course_id" value="{{$vv->course_id}}" @if($vv->course_id == $v->course_id) selected @endif>{{$vv->course_name}} </option>
                @endforeach
        </select>
    </div>
    <div class="form-inline">

        <select name="favorite_id" class="f_id form-control" id="" style="width: auto;">

                @foreach($favorite_info as $vvv)
                    <option class="course_id" value="{{$vvv->favorite_id}}" @if($vvv->favorite_id == $v->favorite_id) selected @endif>{{$vvv->favorite_name}} </option>
                @endforeach
        </select>
    </div>
    <div class="form-inline">

        <input type="hidden" name="collect_id" class="collect_id" value="{{$v->collect_id}}">
        <input type="hidden" name="u_id" class="u_id" value="{{$v->u_id}}">

        <input type="button" value="修改收藏" class="collect_update">
    </div>
            @endforeach

    <script>
        //        var c_id='';
        //        $(document).on("change",".c_id",function () {
        //            c_id=$(this).val();
        //            alert(c_id);
        //        });


        $(document).on("click",".collect_update",function () {

            var collect_id=$(".collect_id").val();
            var course_id=$(".c_id").val();
            var favorite_id=$(".f_id").val();
            var u_id=$(".u_id").val();
            var url="{{asset('CollectController/collectupdate')}}";

//        alert('课程'+course_id);
//        alert(u_id);return;
            $.ajax({
                url:url,
                data: { course_id: course_id,favorite_id:favorite_id,collect_id:collect_id,u_id:u_id},
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
                window.location.href="{{url('CollectController/collect_list')}}";
            }else{

            }
        }

    </script>
@endsection