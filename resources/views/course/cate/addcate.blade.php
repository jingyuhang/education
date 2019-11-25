@extends('layouts.app')
@section('title','课程分类添加')
@section('content')
@include('public.left')
<center>
    <h3>课程分类添加</h3>
    <div class="form-group">
        <label for="exampleInputEmail1">分类名称</label>
        <input type="text" class="form-control" name="cate_name" id="cate_name"><span id="sp"></span></br>
        <select name="pid" id="pid">
            <option value="">---请选择---</option>
            @foreach($data as $v)
            <option value="{{$v['cate_id']}}" id="cate_id">{{str_repeat('-',$v['level'])}}{{$v['cate_name']}}</option>
            @endforeach
        </select>
    </div>
    <button class="btn">添加</button>
</center>
<script type="text/javascript">
    $(document).on('click','.btn',function(){
        var cate_name = $.trim($("#cate_name").val());
        var cate_id = $.trim($('#pid option:selected').attr('value'));
        $.ajax({
            url:"http://www.edublog.com/course/cate/add",
            type:'POST',
            data:{cate_name:cate_name,cate_id:cate_id},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/cate';
                }else{
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/cate/cateadd';
                }
            }
        })
    })
</script>
@endsection