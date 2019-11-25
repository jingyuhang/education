@extends('layouts.app')
@section('title','课程章节展示')
@section('content')
@include('public.left')
<center>
<a href="{{ url('course/part/part') }}" class="layui-btn">添加章节</a>
    <h1>章节列表</h1>
    <table class="table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>章节编码</td>
            <td>章节名称</td>
            <td>章节标题</td>
            <td>章节描述</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr part_id="{{$v->part_id}}">
                <td>{{$v->part_id}}</td>
                <td>{{$v->part_name}}</td>
                <td>{{$v->part_head}}</td>
                <td>{{$v->part_describe}}</td>
                <td><a href="javascript:;" class="del btn-danger">删除</a>
                <a href="{{url('course/part/partedit')}}?part_id={{$v->part_id}}" class="btn btn-danger">修改</a>
                </td>
            </tr>
        @endforeach
    </table>
</center>
<script>
    $(document).on('click','.del',function(){
        var part_id=$(this).parents('tr').attr('part_id');
        // alert(course_id);
        $.ajax({
            url:"http://www.edublog.com/course/part/partdel",
            type:'POST',
            data:{part_id:part_id},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/part';
                }
            }
        })
    })
</script>
@endsection