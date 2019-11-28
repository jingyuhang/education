@extends('layouts.app')
@section('title','活动展示')
@section('content')
@include('public.left')
<a href="{{ url('ActivityController/activity_add_view') }}" class="layui-btn">添加活动</a>
    <form action="{{url('/ActivityController/activity_show')}}" method="get">
        活动标题：<input type="text" name="activity_title" id="" value="">
        <input type="submit" value="搜索">
    </form>
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>精彩活动ID</td>
            <td>精彩活动标题</td>
            <td>精彩活动内容</td>
            <td>创建时间</td>
            <td>浏览次数</td>
            <td>操作</td>
        </tr>
        @foreach($activity_info as $v)
            <tr>
                <td><input type="checkbox" name="haha" value="{{$v->activity_id}}" id="activity_id">{{$v['activity_id']}}</td>
                <td>{{$v['activity_title']}}</td>
                <td>{{$v['activity_content']}}</td>
                <td>{{date("Y-m-d H:i:s",$v['activity_time'])}}</td>
                <td>{{$v['activity_num']}}</td>
                <td>
                    <a href="{{url('/ActivityController/activity_update_view',['activity_id'=>$v['activity_id']])}}">修改</a>
                    <a href="{{url('/ActivityController/activitydel',['activity_id'=>$v['activity_id']])}}">删除</a>

                </td>

            </tr>
        @endforeach

    </table>

    {{ $activity_info->links() }}
    {{--{{ $data->appends(['goods_name' => $goods_name])->links() }}--}}
    <center><a href="javascript:;" class="btn btn-danger">参加该活动</a></center>
    <script>
        $(document).on('click','#shanchu',function () {
            var _this=$(this);
            var url="{{asset('/ActivityController/activityupdate')}}";
            var activity_id=$(_this).attr('activity_id');
//        alert(activity_id);return;
            $.ajax({
                url:url,
                type:'post',
                data:{activity_id:activity_id},
                datatype:'json',
                success:function(res){
                    console.log(res);
                }
            })
        });
        var course_id = getQueryString("course_id");
        $(document).on('click','.btn',function(){
            var aa =[];//定义一个数组
            $('input[name="haha"]:checked').each(function(){//遍历每一个名字为interest的复选框，其中选中的执行函数 
                aa.push($(this).val());//将选中的值添加到数组course_id_array中
            });
            // alert(aa);
            $.ajax({
                url:"http://www.edublog.com/course/create_course_activity",
                type:'POST',
                data:{aa:aa,course_id:course_id},
                dataType:'json',
                success:function(res){
                    // console.log(res);
                    if(res.code==1){
                        alert(res.msg);
                        location.href='http://www.edublog.com/course/course';
                    }
                }
            })
        })
        function getQueryString(name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = window.location.search.substr(1).match(reg);
        if (r != null) return unescape(r[2]); return null;
        }

    </script>

@endsection