@extends('layouts.app')
@section('title','教师收益')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
    @include('public.left')
<table class="layui-table" lay-filter="demo">
  <thead>
    <tr>
      <th>收益编号</th>
      <th>用户名</th>
      <th>购买课程</th>
      <th>订单编号</th>
      <th>获得收益(70%)</th>
      <th>购买时间</th>
    </tr>
    @foreach($data as $v)
      
    <tr>
      <th>{{$v['pt_id']}}</th>
      <th>{{$v['u_email']}}</th>
      <th>{{$v['course_name']}}</th>
      <th>{{$v['order_mark']}}</th>
      <th class="price">￥&nbsp;{{$v['pp']}}</th>
      <th>{{date("Y-m-d H:i:s",$v['pt_time'])}}</th>
    </tr>
    
    @endforeach
  </thead>
</table>
<div>累计收益<span>￥&nbsp;{{$total_price}}</span></div>
</div>
@endsection