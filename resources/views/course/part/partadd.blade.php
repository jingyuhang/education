@extends('layouts.app')
@section('title','课程章节添加')
@section('content')
@include('public.left')
<center>
    <h3>章节添加</h3>
    <div class="form-group">
        <label for="exampleInputEmail1">章节名称</label>
        <input type="text" class="form-control" name="part_name" id="part_name"><span id="sp"></span></br>
        课程名称<select name="pid" id="pid">
            <option value="">---请选择---</option>
            @foreach($data as $v)
            <option value="{{$v->course_id}}" id="course_id">{{$v->course_name}}</option>
            @endforeach
        </select>
    </div>
    <label for="exampleInputEmail1">章节标题</label>
    <input type="text" class="form-control" name="part_head" id="part_head"></br>
    <label for="exampleInputEmail1">章节描述</label>
    <input type="text" class="form-control" name="part_describe" id="part_describe"></br>
    <label for="exampleInputEmail1">是否免费</label>
    <input type="radio" name="is_free" id='is_free' value="1" checked="">免费
    <input type="radio" name="is_free" id='is_free' value="2">收费</br>
    <button class="btn">添加</button>
</center>
<script type="text/javascript">
    $(document).on('click','.btn',function(){
        var part_name = $.trim($("#part_name").val());
        var part_head = $.trim($("#part_head").val());
        var part_describe = $.trim($("#part_describe").val());
        var is_free = $.trim($("#is_free").val());
        var course_id = $.trim($('#pid option:selected').attr('value'));
        // alert(1);
        $.ajax({
            url:"http://www.edublog.com/course/part/partadd",
            type:'POST',
            data:{part_name:part_name,part_head:part_head,part_describe:part_describe,is_free:is_free,course_id:course_id},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/part';
                }else{
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/part/partadd';
                }
            }
        })
    })
</script>
@endsection