@extends('layouts.app')
@section('title','活动添加')
@section('content')
@include('public.left')
    <form>
        <div class="form-inline">
            <label for="activitypleInputEmail1" ><b style="font-size: 18px;color: blue">精彩活动标题</b></label>
            <input type="text"  name="activity_title" class="form-control activity_title"  placeholder="精彩活动标题" style="width: auto">
        </div>
        <div class="form-inline">
            <label for="activitypleInputPassword1"><b style="font-size: 16px;color: blue">精彩活动内容</b></label>
            <textarea class="form-control activity_content" name="activity_content" id="" cols="30" rows="10" placeholder="精彩活动内容"></textarea>

        </div>
        <div class="form-inline">
            <label for="activitypleInputEmail1" ><b style="font-size: 18px;color: blue">浏览次数</b></label>
            <input type="number"  name="activity_num" class="form-control activity_num"  placeholder="浏览次数" style="width: auto">
        </div>

        <input type="button" value="添加精彩活动" class="activity_add form-group">

    </form>
    <script>
        $(document).on("click",".activity_add",function () {
            var activity_title=$("input.activity_title").val();
            var activity_content=$(".activity_content").val();
            var activity_num=$(".activity_num").val();
            var url="{{asset('ActivityController/activityadd')}}";

            $.ajax({
                url:url,
                data: {activity_title: activity_title, activity_content: activity_content,activity_num:activity_num},
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if(res.code==1){
                        alert(res.msg);
                        location.href='http://www.edublog.com/ActivityController/activity_show';
                    }else{
                        alert(res.msg);
                    }
                }
            })

        });


    </script>
@endsection()