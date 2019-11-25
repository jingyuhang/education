@extends('layouts.app')
@section('title','课程修改')
@section('content')
@include('public.left')
<center>
    <h3>课程添加</h3>
    <form action='http://www.edublog.com/course/course/courseupdate' method='post' enctype="multipart/form-data" id='avatar'>
        <div class="form-group">
            @foreach($data as $v)
            <input type="hidden" name='course_id' value="{{$v->course_id}}">

            <label for="exampleInputEmail1">课程名称</label>
            <input type="text" class="form-control" name="course_name" id="course_name" value="{{$v->course_name}}"></br>
            <label for="exampleInputEmail1">课程图片</label>
            <img width='30%'  height='30%' src="{{asset($v->title_picture)}}" alt=""><br>
            <label for="exampleInputEmail1">上传新图片</label>
            <input type="file" class="form-control" name="title_picture" id="title_picture"></br>
            <label for="exampleInputEmail1">课程介绍</label>
            <input type="text" class="form-control" name="intro" id="intro" value="{{$v->intro}}"></br>
            <label for="exampleInputEmail1">是否免费</label>
            <input type="radio" name="is_free" id='is_free' value="1" checked="">免费
            <input type="radio" name="is_free" id='is_free' value="2">收费</br>
            <label for="exampleInputEmail1">课程价格</label>
            <input type="text" class="form-control" name="course_price" id="course_price" value="{{$v->course_price}}"></br>
            @endforeach
        </div>
        
        <button class="submit">修改</button>

        </form>
</center>
<!-- <script type="text/javascript">
$(document).on('click','.btn',function(){
        var course_name=$('#course_name').val();
        // var title_picture=$('#title_picture').val();
        var title_picture = $('#title_picture')[0].files[0];

        console.log(title_picture);
        // return false;    


        var intro=$('#intro').val();
        var is_free=$('#is_free').val();
        var course_price=$('#course_price').val();
        var course_id=getQueryString('course_id');
        // alert(cate_id);
        // alert(cate_name);
        $.ajax({
            url:"http://www.edublog.com/course/course/courseupdate",
            type:'POST',
            data:{course_name:course_name,title_picture:title_picture,intro:intro,is_free:is_free,course_price:course_price,course_id:course_id},
            dataType:'json',
            contentType: false, 
            processData: false, 
            success:function(res){
                console.log(res);
                if(res.code==1){
                    alert(res.msg);
                    location.href='http://www.edublog.com/course/course';
                }
            }
        })
    })
    function getQueryString(course_id) {
				var reg = new RegExp("(^|&)" + course_id + "=([^&]*)(&|$)", "i");
				var r = window.location.search.substr(1).match(reg);
				if (r != null) return unescape(r[2]); return null;
	}
</script> -->
<!-- <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>  -->
<!-- <script type="text/javascript"> 
$(document).on('click','.btn',function(){
    // function uploadInfo() { 
        alert(1);
    var formData = new FormData($("#avatar")); 
    // console.log(formData);
            $.ajax({ 
            url: "http://www.edublog.com/course/course/courseupdate",
            type: 'POST', 
            data: formData, 
            contentType: false, 
            processData: false, 
            success: function (res) { 
                console.log(res); 
            }, 
            }); 
    // } 
})


</script> -->
@endsection