@extends('layouts.app')
@section('content')
@include('public.left')
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>课程ID</td>
            <td>课程名称</td>
            <td>讲师名称</td>
            <td>总课时</td>
            <td>是否免费</td>
            <td>课程价格</td>


        </tr>
        @foreach($course_info as $v)
            <tr>
                <td>{{$v->course_id}}</td>
                <td>{{$v->course_name}}</td>
                <td>{{$v->lect_name}}</td>
                <td>{{$v->course_total}}</td>
                <td>@if($v->is_free==1)免费 @else 付费 @endif</td>
                <td>{{$v->course_price}}</td>
            </tr>
        @endforeach

    </table>

    <script>

    </script>

@endsection