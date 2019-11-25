@extends('layouts.app')
@section('content')
@include('public.left')
    <?php
    session_start();
    $_SESSION["user_id"]="1";
    ?>
    <a href="{{ url('course/course') }}" class="layui-btn">添加收藏</a>
    <form action="{{url('/CollectController/collect_list')}}" method="get">
        课程名称：<input type="text" name="course_name" id="" value="">
        收藏夹名称：<input type="text" name="favorite_name" id="" value="">
        <input type="hidden" name="u_id" id="" value="<?php echo $_SESSION['user_id']?>">
        <input type="submit" value="搜索">
    </form>
    <table border="1">
        <tr>
            <td>收藏ID</td>
            <td>课程名称</td>
            <td>用户id</td>
            <td>收藏名称</td>
            <td>创建时间</td>
            <td>是否删除</td>
            <td>操作</td>
        </tr>
        @foreach($collect_info as $v)
            <tr>
                <td>{{$v['collect_id']}}</td>
                <td>{{$v['course_name']}}</td>
                <td>{{$v['u_id']}}</td>
                <td>{{$v['favorite_name']}}</td>
                <td>{{$v['create_time']}}</td>
                <td>@if($v['is_del']==1)未删除 @else 已删除@endif</td>
                <td>
                    <a href="{{url('/CollectController/collect_update_view',['collect_id'=>$v['collect_id']])}}">修改</a>
                    <a href="{{url('/CollectController/collectdel',['collect_id'=>$v['collect_id'],'u_id'=>$v['u_id']])}}">删除</a>

                </td>

            </tr>
        @endforeach

    </table>

    {{--{{ $collect_info->links() }}--}}
    {{ $collect_info->appends(['course_name' => $course_name,'favorite_name'=>$favorite_name])->links() }}
    <script>

{{--        {{ $collect_info->appends(['favorite_name' => ])->links() }}--}}

        $(document).on('click','#shanchu',function () {
            var _this=$(this);
            var url="{{asset('/CollectController/collectupdate')}}";
            var collect_id=$(_this).attr('collect_id');
//        alert(collect_id);return;
            $.ajax({
                url:url,
                type:'post',
                data:{collect_id:collect_id},
                datatype:'json',
                success:function(res){
                    console.log(res);
                }
            })
        });



    </script>

@endsection