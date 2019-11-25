@extends('layouts.app')
@section('title','作业添加')
@section('content')
@include('public.left')
    <h1>作业添加</h1>
    <div>
        <form class="layui-form" action="/course/job/store">
            <div class="layui-form-item">
                <label class="layui-form-label">课程</label>
                <div class="layui-input-inline" style="z-index: 9999;">
                <select class="form-control" name="course_id" lay-filter="kk" id="kk">
                    <option value="">请选择</option>
                    @foreach($coursedata as $c)
                        <option value="{{$c->course_id}}">{{$c->course_name}}</option>
                    @endforeach
                </select>
                </div> 
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">章节</label>
                <div class="layui-input-inline" style="z-index: 9999;">
                <select name="part_id" id="" class="form-control cate">
                    <option value="">请选择</option>
                </select>
                </div> 
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">作业名称</label>
                <div class="layui-input-inline">
                    <input type="type" class="form-control" name="job_name">
                </div>
            </div>
            <div id="attr" class="layui-form-item">
                <div class="layui-input-block">
                    <button class="btn btn-sm btn-primary " type="submit" id="btn" ><strong>添 加</strong>
                    </button>
                </div>
            </div>
        </form>
    </div>
<script>
    function renderForm(){
        layui.use('form', function(){
            var form = layui.form;//高版本建议把括号去掉，有的低版本，需要加()
            form.render();
        });
    }
    layui.use('form',function(){
        var form=layui.form;
        form.on('select(kk)', function(){
            var course_id=$('#kk').val();
            $('.cate').empty();
            $.ajax({
                url:"/course/job/change",
                data:{course_id:course_id},
                type:"post",
                dataType:"json",
                success:function(res){
                    if(res.code==200){
                        var data = res.data;
                        var option='<option value="">请选择</option>';
                        for(var i in data){
                            option += ' <option value="'+data[i].part_id+'">'+data[i].part_name+'</option>';
                        }
                        $('.cate').html(option);
                        renderForm();
                    }
                   
                }
            })
        });
       
    })
</script>
@endsection
