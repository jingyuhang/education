@extends('layouts.app')
@section('title','课程添加')
@section('content')
@include('public.left')
<center>
    <h3>课程添加</h3>
    <form action="{{url('course/course/courseadd')}}" method="POST" enctype="multipart/form-data" id='form'>
        <div class="form-group">
            <select name="pid" id="pid">
                <option value="">---请选择---</option>
                @foreach($data as $v)
                <option value="{{$v->cate_id}}" id="cate_id">{{str_repeat('-',$v->level)}}{{$v->cate_name}}</option>
                @endforeach
                <input type="hidden" name="cate_id" value="{{$v->cate_id}}">
            </select></br>
            <label for="exampleInputEmail1">课程名称</label>
            <input type="text" class="form-control" name="course_name" id="course_name"></br>
            <label for="exampleInputEmail1">课程图片</label>
            <input type="file" class="form-control" name="title_picture" id="title_picture"></br>
            <label for="exampleInputEmail1">课程介绍</label>
            <input type="text" class="form-control" name="intro" id="intro"></br>
            <label for="exampleInputEmail1">是否免费</label>
            <input type="radio" name="is_free" id='is_free' value="1" checked="">免费
            <input type="radio" name="is_free" id='is_free' value="2">收费</br>
            <label for="exampleInputEmail1">课程价格</label>
            <input type="text" class="form-control" name="course_price" id="course_price"></br>
        </div>
        <button class="btn">添加</button>
    </form>
</center>
<script type="text/javascript">
</script>
@endsection