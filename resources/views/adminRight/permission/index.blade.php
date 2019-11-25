@extends('layouts.app')
@section('title','权限展示')
@section('content')
    <div class="wrapper">
        <!--左侧导航开始-->
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

    <a href="{{ url('adminRight/permission/create') }}" class="layui-btn">添加权限</a>
    <table class="layui-table">
        <colgroup>
            <col width="50">
            <col width="130">
            <col>
            <col width="110">
            <col width="115">
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>路由</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td>{{ $permission->id }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    @foreach(explode(',',$permission->routes) as $route)
                        <span class="layui-badge layui-bg-green">{{ $route }}</span>
                    @endforeach
                </td>
                <td style="text-align: center;">
                    <a href="{{ url('adminRight/permission/edit') }}?permission_id={{ $permission->id }}"
                       class="layui-btn layui-btn-xs">编辑</a>
                    <button class="layui-btn layui-btn-danger layui-btn-xs" type="button"
                            onclick="del({{ $permission->id }})">删除
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div id="page" class="layui-box layui-laypage layui-laypage-default">{{ $permissions->links() }}</div>

    <script>
        layui.use(['layer'], function () {
            var layer = layui.layer;
        });

        function del(id) {
            layer.confirm('你确定要删除这个权限吗？', {
                title: '删除确认',
                btn: ['确定', '取消'] //按钮
            }, function () {
                layer.confirm('该权限组下的角色用户将失去对应的权限，确定要删除吗？', {
                    title: '删除确认',
                    btn: ['确定', '取消'] //按钮
                }, function () {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });
                    var load = layer.load();
                    $.post("{{ url('adminRight/permission/delete') }}", {id: id},
                        function (data) {
                            layer.close(load);
                            if (data.code === 0) {
                                layer.msg('操作成功', {
                                    offset: '15px'
                                    , icon: 1
                                    , time: 1000
                                }, function () {
                                    location.href = "{{ url('adminRight/permission') }}";
                                });
                            } else {
                                layer.msg(data.msg, {
                                    offset: '15px'
                                    , icon: 2
                                    , time: 2000
                                });
                            }
                        });
                })
            });
        }
    </script>
@endsection