@extends('layouts.app')
@section('title','作业修改')
@section('content')
@include('public.left')
    <h1>作业修改</h1>
    <div style="font-size: 50px; margin:0;" >
        <form action="/course/job/update">

            <div class="form-group">
                <label>课程</label>
                <select class="form-control"  name="course_id" id="kk">
                    @foreach($course as $c)
                        <option value="{{$c->course_id}}" >{{$c->course_name}}</option>
                        @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>章节</label>
                <input type="hidden" name="job_id" value="{{$data->job_id}}">
                {{--<input type="type" class="form-control" name="part_id" >--}}
                <select name="part_id" value="{{$data->part_id}}" id="" class="form-control cate">
                   @foreach($catalog as $l)
                    <option value="{{$l->part_id}}" @if($l->part_id==$data->part_id) selected @endif>{{$l->part_name}}</option>
                       @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>作业名称</label>
                <input type="type" class="form-control" value="{{$data->job_name}}" name="job_name">
            </div>

            <div id="attr">
                <button class="btn btn-sm btn-primary " type="submit" id="btn" ><strong>修改</strong>
                </button>
            </div>
        </form>
    </div>
<script>
    $(document).on('change','#kk',function(){
        var course_id=$(this).val();
//        alert(course_id);return;
        $('.cate').empty();
        $.ajax({
            url:"/course/job/change",
            data:{course_id:course_id},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code=200){
                    var data = res.data;
                    console.log(data);
                    var q = '<option></option>'
                    for(var i in data){
//                        console.log(i);
                        q = ' <option value="'+data[i].part_id+'">'+data[i].part_name+'</option>';
//                        console.log(q);
                        $('.cate').append(q);
                    }
                }
            }
        })
    })
</script>
@endsection
