@extends('layouts.app')
@section('content')
@include('public.left')
<?php
session_start();
$_SESSION["user_id"]="1";
?>
<tableclass="table table-bordered table-hover table-striped" border="1">
    <tr>
        <td>课程id</td>
        <td>课程名称</td>
        <td>教师id</td>
        <td>操作</td>
    </tr>
    @foreach($course_info as $v)
    <tr>
        <td class="course_id">
            {{$v['course_id']}}
        </td>
        <td>
            <input type="hidden" name="user_id" value="1">
            {{$v['course_name']}}
        </td>
        <td>{{$v['lecturer_id']}}</td>
        <td>
            <a href="{{url('/CollectController/create_favorite_view',['course_id'=>$v['course_id'],'user_id'=>$_SESSION['user_id']])}}">收藏</a>
        </td>
    </tr>
    @endforeach
</table>
@endsection
<script src="/jquery.min.js"></script>
<script>



    {{--$(document).on('click',"#collect",function () {--}}

        {{--var user_id=1;--}}
        {{--var _this=$(this);--}}
        {{--var courser_id =_this.parent().parent().children("td").first().html();--}}
        {{--var url ="{{url('1')}}";--}}
        {{--$.ajax({--}}
            {{--url:url,--}}
            {{--data: {user_id: user_id, courser_id: courser_id},--}}
            {{--type: 'post',--}}
            {{--dataType: 'json',--}}
            {{--success: function (res) {--}}
                {{--console.log(res);--}}
{{--//            if(res.code==1){--}}
{{--//                alert(res.msg);--}}
{{--//            }else{--}}
{{--//                alert(res.msg);--}}
{{--//            }--}}
            {{--}--}}
        {{--})--}}
    {{--});--}}
//    alert(courser_id);



</script>



