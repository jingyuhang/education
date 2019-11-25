@extends('layouts.app')
@section('title','资讯展示')
@section('content')
@include('public.left')
        <a href="{{ url('informationadd_view') }}" class="layui-btn">添加资讯</a>
        <form action="{{url('/InformationController/informationshow')}}" method="get">
            咨询标题：<input type="text" class="form-control" name="information_title" id="" value="{{$information_title}}">
            咨询内容：<input type="text" class="form-control" name="information_content" id="" value="{{$information_content}}">
            <input type="submit" class="form-control" value="搜索">
        </form>

        <table class="layui-table table-bordered table-hover table-striped" border="1">
            <tr>
                <td>资讯ID</td>
                <td>资讯标题</td>
                <td>资讯内容</td>
                <td>logo</td>
                <td>创建时间</td>
                <td>浏览次数</td>
                <td>操作</td>
            </tr>
            @foreach($information_info as $v)
                <tr>
                    <td>{{$v['information_id']}}</td>
                    <td>{{$v['information_title']}}</td>
                    <td>{{$v['information_content']}}</td>
                    <td><img src="{{asset($v['information_photo'])}}" width="100"></td>
                    <td>{{date("Y-m-d H:i:s",$v['information_time'])}}</td>
                    <td>{{$v['information_num']}}</td>
                    <td>
                        <a href="{{url('/InformationController/informationupdate_view',['information_id'=>$v['information_id']])}}">修改</a>
                        <a href="{{url('/InformationController/informationdel',['information_id'=>$v['information_id']])}}">删除</a>

                    </td>

                </tr>
            @endforeach

        </table>

    {{--{{ $information_info->links() }}--}}
    {{ $information_info->appends(['information_content' => $information_content,'information_title'=>$information_title])->links() }}
<script>
    $(document).on('click','#shanchu',function () {
        var _this=$(this);
        var url="{{asset('/InformationController/informationupdate')}}";
        var information_id=$(_this).attr('information_id');
//        alert(information_id);return;
        $.ajax({
            url:url,
            type:'post',
            data:{information_id:information_id},
            datatype:'json',
            success:function(res){
                console.log(res);
            }
        })
    });



</script>

@endsection