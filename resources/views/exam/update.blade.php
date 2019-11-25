@extends('layouts.app')
@section('title','考试修改')
@section('content')
@include('public.left')s
    <form>
        <div class="form-inline">
            <label for="exampleInputEmail1" ><b style="font-size: 18px;color: blue">考试标题</b></label>
            <input type="text"  name="exam_title" class="form-control exam_title"  placeholder="考试标题" style="width: auto" value="{{$exam_info['exam_title']}}">
        </div>
        <div class="form-inline">
            <label for="exampleInputPassword1"><b style="font-size: 16px;color: blue">考试内容</b></label>
            <textarea class="form-control exam_content" name="exam_content" id="" cols="30" rows="10" placeholder="考试内容">{{$exam_info['exam_content']}}</textarea>

        </div>
        <div class="form-inline">
            <label for="exampleInputEmail1" ><b style="font-size: 18px;color: blue">浏览次数</b></label>
            <input type="number"  name="exam_num" class="form-control exam_num"  placeholder="浏览次数" style="width: auto" value="{{$exam_info['exam_num']}}">
        </div>
        <input type="hidden" name="exam_id" id="exam_id" value="{{$exam_info['exam_id']}}">
        <input type="button" value="修改考试" class="exam_edit form-group">

    </form>

    <script>
        $(document).on("click",".exam_edit",function () {
            var exam_title=$("input.exam_title").val();
            var exam_content=$(".exam_content").val();
            var exam_num=$(".exam_num").val();
            var exam_id=$("#exam_id").val();
            var url="{{asset('ExamController/examupdate')}}";

            $.ajax({
                url:url,
                data: {exam_title: exam_title, exam_content: exam_content,exam_num:exam_num,exam_id:exam_id},
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


@endsection