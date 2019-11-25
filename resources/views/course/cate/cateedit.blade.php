@extends('layouts.app')
@section('title','课程分类修改')
@section('content')
@include('public.left')
<center>
    <h3>课程分类修改</h3>
    <div class="form-group">
        <label for="exampleInputEmail1">分类名称</label>
        @foreach($data as $v)
        <input type="text" class="update form-control" name="cate_name" id="cate_name" value="{{$v->cate_name}}"><span id="sp"></span></br>
        @endforeach
    </div>
    <button class="btn">修改</button>
</center>
<script type="text/javascript">
$(document).on('click','.btn',function(){
        var cate_name=$('#cate_name').val();
        var cate_id=getQueryString('cate_id');
        // alert(cate_id);
        // alert(cate_name);
        $.ajax({
            url:"http://www.edublog.com/course/cate/cateupdate",
            type:'POST',
            data:{cate_name:cate_name,cate_id:cate_id},
            dataType:'json',
            success:function(res){
                // console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/cate';
                }
            }
        })
    })
    function getQueryString(cate_id) {
				var reg = new RegExp("(^|&)" + cate_id + "=([^&]*)(&|$)", "i");
				var r = window.location.search.substr(1).match(reg);
				if (r != null) return unescape(r[2]); return null;
	}
</script>
@endsection