@extends('layouts.app')
@section('content')
@include('public.left')
    {{--<form action="{{url('/OrderController/detail_show')}}" method="get">--}}
        {{--<div class="form-inline">--}}
            {{--讲师：--}}
            {{--<select name="lect_id" value="{{$lect_id}}" class="c_id form-control" id="" style="width: auto;">--}}
                {{--<option value="">请选择讲师</option>--}}

                {{--@foreach($teacher_info as $v)--}}
                    {{--<option class="lect_id" value="{{$v['lect_id']}}" @if($lect_id==$v['lect_id']) selected @endif>{{$v['lect_name']}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}


            {{--课程：--}}
            {{--<select name="course_id" value="{{$course_id}}" class="c_id form-control" id="" style="width: auto;">--}}
                {{--<option value="">请选择课程</option>--}}

                {{--@foreach($course_info as $v)--}}
                    {{--<option class="course_id" value="{{$v['course_id']}}" @if($course_id==$v['course_id']) selected @endif>{{$v['course_name']}}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
            {{--<input type="submit" class="btn btn-success" value="搜索">--}}
        {{--</div>--}}
    {{--</form>--}}


    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>订单详情ID</td>
            <td>课程名称</td>
            <td>讲师名称</td>
            <td>用户id</td>
            <td>是否免费</td>
            <td>课程价格</td>
            <td>创建时间</td>
            <td>是否删除</td>
            <td>操作</td>
        </tr>
        @foreach($detail_info as $v)
            <tr>
                <td>{{$v->detail_id}}</td>
                <td>{{$v->course_name}}</td>
                <td>{{$v->lect_name}}</td>
                <td>{{$v->u_id}}</td>
                <td>@if($v->is_free==1)免费 @else 付费 @endif</td>
                <td>{{$v->course_price}}</td>
                <td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
                <td>@if($v->is_del==1)未删除 @else已删除 @endif</td>
                <td>
                    <a class="btn btn-success" href="{{url('/OrderController/select_user_detail',['detail_id'=>$v->detail_id])}}">用户详情</a>
                    <a class="btn btn-success" href="{{url('/OrderController/select_teacher_detail',['detail_id'=>$v->detail_id])}}">讲师详情</a>
                    <a class="btn btn-success" href="{{url('/OrderController/select_course_detail',['detail_id'=>$v->detail_id])}}">课程详情</a>
                    <a class="btn btn-info" href="{{url('/OrderController/detail_update_view',['detail_id'=>$v->detail_id])}}">修改</a>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $detail_info->appends(['lect_id' => $lect_id,'course_id'=>$course_id])->links() }}

    <script>
//        var str='11';
//        console.log(str.length);

    </script>

@endsection