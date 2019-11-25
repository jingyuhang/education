@extends('layouts.app')
@section('title','管理员展示')
@section('content')

    @include('public.left')
    <style>
        #page li {
            display: inline-block;
        }

        #page .active span {
            background-color: #009688;
            color: #fff;
            border: 0px;
            height: 30px;
            border-radius: 2px;
        }

        #page .disabled span {
            color: #ccc;
        }
    </style>

    <table class="layui-table">
        <colgroup>
            <col width="50">
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>邮箱</th>
            <th>是否管理员</th>
            <th>所属角色</th>
            <th>状态</th>
            <th>创建时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->administrator==\App\Model\Users::ADMIN_YES?'是':'否' }}</td>
                <td>
                    @foreach($user->roles as $role)
                        <span class="layui-badge layui-bg-green">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td>
                    @if($user->status==\App\Model\Users::STATUS_ENABLE)
                        <span style="color:#009688;">启用</span>
                    @else
                        <span style="color:#FF5722;">禁用</span>
                    @endif
                </td>
                <td>{{ $user->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page" class="layui-box layui-laypage layui-laypage-default">{{ $data->links() }}</div>
@endsection