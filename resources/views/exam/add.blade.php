@extends('layouts.app')
@section('title','考试添加')
@section('content')
@include('public.left')
    <form>
        <div class="form-inline">
            <label for="exampleInputEmail1" ><b style="font-size: 18px;color: blue">考试指导标题</b></label>
            <input type="text"  name="exam_title" class="form-control exam_title"  placeholder="考试指导标题" style="width: auto">
        </div>
        <div class="form-inline">
            <label for="exampleInputPassword1"><b style="font-size: 16px;color: blue">考试指导内容</b></label>
            <textarea class="form-control exam_content" name="exam_content" id="" cols="30" rows="10" placeholder="考试指导内容"></textarea>

        </div>
        <div class="form-inline">
            <label for="exampleInputEmail1" ><b style="font-size: 18px;color: blue">浏览次数</b></label>
            <input type="number"  name="exam_num" class="form-control exam_num"  placeholder="浏览次数" style="width: auto">
        </div>

        <input type="button" value="添加考试" class="exam_add form-group">

    </form>
    <script>
        $(document).on("click",".exam_add",function () {
            var exam_title=$("input.exam_title").val();
            var exam_content=$(".exam_content").val();
            var exam_num=$(".exam_num").val();
            var url="{{asset('ExamController/examadd')}}";

            $.ajax({
                url:url,
                data: {exam_title: exam_title, exam_content: exam_content,exam_num:exam_num},
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if(res.code==1){
                        alert(res.msg);
                    }else{
                        alert(res.msg);
                    }
                }
            })

        });


    </script>
@endsection()