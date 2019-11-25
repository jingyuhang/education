@extends('layouts.app')
@section('title','课程章节修改')
@section('content')
@include('public.left')
<center>
    <h3>章节修改</h3>
    @foreach($data as $v)
    <div class="form-group">
        <label for="exampleInputEmail1">章节名称</label>
        <input type="text" class="form-control" name="part_name" id="part_name" value="{{$v->part_name}}"><span id="sp"></span></br>
    </div>
    <label for="exampleInputEmail1">章节标题</label>
    <input type="text" class="form-control" name="part_head" id="part_head" value="{{$v->part_head}}"></br>
    <label for="exampleInputEmail1">章节描述</label>
    <input type="text" class="form-control" name="part_describe" id="part_describe" value="{{$v->part_describe}}"></br>
    <label for="exampleInputEmail1">是否免费</label>
    <input type="radio" name="is_free" id='is_free' value="1" checked="">免费
    <input type="radio" name="is_free" id='is_free' value="2">收费</br>
    <button class="btn">修改</button>
    @endforeach
</center>
<script type="text/javascript">
    $(document).on('click','.btn',function(){
        var part_name = $.trim($("#part_name").val());
        var part_head = $.trim($("#part_head").val());
        var part_describe = $.trim($("#part_describe").val());
        var is_free = $.trim($("#is_free").val());
        var part_id=getQueryString('part_id');
        $.ajax({
            url:"http://www.edublog.com/course/part/partupdate",
            type:'POST',
            data:{part_name:part_name,part_head:part_head,part_describe:part_describe,is_free:is_free,part_id,part_id},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/part';
                }else{
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/part/partedit';
                }
            }
        })
    })
    function getQueryString(part_id) {
				var reg = new RegExp("(^|&)" + part_id + "=([^&]*)(&|$)", "i");
				var r = window.location.search.substr(1).match(reg);
				if (r != null) return unescape(r[2]); return null;
	}
</script>
@endsection