@extends('layouts.app')
@section('title','考试展示')
@section('content')
@include('public.left')
<a href="{{ url('informationadd_view') }}" class="layui-btn">添加考试</a>
    <div class="form-inline">
        <form action="{{url('/ExamController/exam_show')}}" method="get">
            考试标题：<input type="text" class="form-control" name="exam_title" id="" value="{{$exam_title}}">
            考试内容：<input type="text" class="form-control" name="exam_content" id="" value="{{$exam_content}}">
            <input type="submit" class="form-control" value="搜索">
        </form>
    </div>
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>考试ID</td>
            <td>考试标题</td>
            <td>考试内容</td>
            <td>创建时间</td>
            <td>浏览次数</td>
            <td>操作</td>
        </tr>
        @foreach($exam_info as $v)
            <tr>
                <td>{{$v['exam_id']}}</td>
                <td>{{$v['exam_title']}}</td>
                <td>{{$v['exam_content']}}</td>
                <td>{{date("Y-m-d H:i:s",$v['exam_time'])}}</td>
                <td>{{$v['exam_num']}}</td>
                <td>
                    <a href="{{url('/ExamController/exam_update_view',['exam_id'=>$v['exam_id']])}}">修改</a>
                    <a href="{{url('/ExamController/examdel',['exam_id'=>$v['exam_id']])}}">删除</a>

                </td>

            </tr>
        @endforeach

    </table>
    {{ $exam_info->appends(['exam_content' => $exam_content,'exam_title'=>$exam_title])->links() }}
    <script>
        $(document).on('click','#shanchu',function () {
            var _this=$(this);
            var url="{{asset('/examController/examupdate')}}";
            var exam_id=$(_this).attr('exam_id');
//        alert(exam_id);return;
            $.ajax({
                url:url,
                type:'post',
                data:{exam_id:exam_id},
                datatype:'json',
                success:function(res){
                    console.log(res);
                }
            })
        });



    </script>

@endsection