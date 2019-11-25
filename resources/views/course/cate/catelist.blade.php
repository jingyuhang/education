@extends('layouts.app')
@section('title','课程分类展示')
@section('content')
@include('public.left')
<center>
<a href="{{ url('course/cate/category') }}" class="layui-btn">添加分类</a>
    <table class="table table-bordered table-hover table-striped" border="1">
        <tr>
            <td>编码</td>
            <td>分类名称</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
            <tr cate_id="{{$v['cate_id']}}" pid="{{$v['pid']}}" style="display:none;">
                <td>{{$v['cate_id']}}{{str_repeat('-',$v['level']*2)}}
                    <a href="javascript:;" class="show">+</a>
                </td>
                <td>{{str_repeat('--',$v['level']*2)}}{{$v['cate_name']}}</td>
                <td><a href="javascript:;" class="del btn btn-danger">删除</a>
                <a href="{{url('course/cate/cateedit')}}?cate_id={{$v['cate_id']}}" class="btn btn-danger">修改</a>
                </td>
            </tr>
        @endforeach
    </table>
</center>
<script>
    $("tr[pid=0]").show();
    //点击+
    $(document).on('click','.show',function(){
        // alert(111);
        var a=$(this).text();
        // alert(a);
        var cate_id=$(this).parents('tr').attr('cate_id');
        // alert(cate_id);
        if(a=='+'){
            if($("tr[pid='"+cate_id+"']").length>0){
                $("tr[pid='"+cate_id+"']").show();
                $(this).text('-');
            }
        }else{ 
            $("tr[pid='"+cate_id+"']").hide();
            $(this).text('+');
        }
        return false;
    })
    $(document).on('click','.del',function(){
        var cate_id=$(this).parents('tr').attr('cate_id');
        // alert(cate_id);
        $.ajax({
            url:"http://www.edublog.com/course/cate/catedel",
            type:'POST',
            data:{cate_id:cate_id},
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
</script>
@endsection