@extends('layouts.app')
@section('title','导航添加')
@section('content')
@include('public.left')
    <form action="{{url('/OrderController/order_show')}}" method="get">
        <div class="form-inline">
            订单编号：<input type="text"  class="form-control" style="width: auto" name="order_mark" id="" value="{{$order_mark}}">
            课程：<select name="course_id" value="{{$course_id}}" class="c_id form-control" id="" style="width: auto;">
                <option value="">请选择课程</option>

                @foreach($course_info as $v)
                    <option class="course_id" value="{{$v['course_id']}}" @if($course_id==$v['course_id']) selected @endif>{{$v['course_name']}}</option>
                @endforeach
            </select>
            <input type="submit" class="btn btn-success" value="搜索">
        </div>
    </form>


    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>订单ID</td>
            <td>订单编号</td>
            <td>课程名称</td>
            <td>用户 id</td>
            <td>支付方式</td>
            <td>支付金额</td>
            <td>支付状态</td>
            <td>操作</td>
        </tr>
        @foreach($order_info as $v)
            <tr>
                <td>{{$v->order_id}}</td>
                <td>{{$v->order_mark}}</td>
                <td>{{$v->course_name}}</td>
                <td>{{$v->u_id}}</td>
                <td>{{$v->pay_name}}</td>
                <td>{{$v->pay_price}}</td>
                {{--<td>{{$v->pay_status}}</td>--}}
                <td>@if($v->pay_status==1)未支付 @elseif($v->pay_status==2) 已支付@else 取消支付 @endif</td>
                <td>
                    <a class="btn btn-info" href="{{url('/OrderController/detail_show',['order_id'=>$v->order_id,'u_id'=>$v->u_id])}}">查看订单详情</a>
                    <a class="btn btn-danger" href="{{url('/OrderController/orderdel',['order_id'=>$v->order_id])}}">删除</a>
                </td>
            </tr>
        @endforeach

    </table>
    {{ $order_info->appends(['order_mark' => $order_mark,'course_id'=>$course_id])->links() }}

    <script>

    </script>

@endsection