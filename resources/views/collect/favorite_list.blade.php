@extends('layouts.app')
@section('content')
@include('public.left')
<?php 
    session_start();
?>
    <form action="{{url('/CollectController/favorite_list')}}" method="get">
        收藏夹名称：<input type="text" name="favorite_name" id="" value="">
        用户id：<input type="u_id" class="u_id" name="u_id" value="">
        <input type="submit" value="搜索">
    </form>
    <table class="table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>收藏夹ID</td>
            <td>用户id</td>
            <td>收藏夹内容</td>
            <td>收藏数量</td>
            <td>是否删除</td>
            <td>操作</td>
        </tr>
        @foreach($favorite_info as $v)
            <tr>
                <td>{{$v['favorite_id']}}</td>
                <td>{{$v['u_id']}}</td>
                <td>{{$v['favorite_name']}}</td>
                <td>{{$v['favorite_num']}}</td>
                <td>@if($v['is_del']==1)未删除 @else 已删除@endif</td>
                <td>
                    <a href="{{url('/CollectController/favorite_update_view',['favorite_id'=>$v['favorite_id']])}}">修改</a>
                    <a href="{{url('/CollectController/favoritedel',['favorite_id'=>$v['favorite_id']])}}">删除</a>
                    <a href="{{url('/CollectController/create_favorite_view_1',['course_id'=>$v['course_id'],'u_id'=>$_SESSION['u_id']])}}" class="layui-btn">添加收藏夹</a>
                </td>

            </tr>
        @endforeach

    </table>
    {{ $favorite_info->links() }}
    {{--{{ $data->appends(['goods_name' => $goods_name])->links() }}--}}
    <script>
        $(document).on('click','#shanchu',function () {
            var _this=$(this);
            var url="{{asset('/CollectController/favoriteupdate')}}";
            var favorite_id=$(_this).attr('favorite_id');
//        alert(favorite_id);return;
            $.ajax({
                url:url,
                type:'post',
                data:{favorite_id:favorite_id},
                datatype:'json',
                success:function(res){
                    console.log(res);
                }
            })
        });



    </script>

@endsection