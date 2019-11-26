@extends('layouts.app')
@section('content')
@include('public.left')
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>用户ID</td>
            <td>用户名称</td>
            <td>用户头像</td>
            <td>用户年龄</td>
            <td>用户性别</td>
            <td>创建时间</td>
            <td>用户级别</td>
            <td>用户邮箱</td>

        </tr>
        @foreach($u_info as $v)
            <tr>
                <td>{{$v->u_id}}</td>
                <td>{{$v->u_name}}</td>
                <td>{{$v->u_head}}</td>
                <td>{{$v->u_age}}</td>
                <td>@if($v->u_sex==1)男 @else 女 @endif</td>
                <td>{{date('Y-m-d H:i:s',$v->u_time)}}</td>
                <td>@if($v->ustatus==1)普通用户@else 会员  @endif</td>
                <td>{{$v->u_email}}</td>
            </tr>
        @endforeach

    </table>

    <script>

    </script>

@endsection