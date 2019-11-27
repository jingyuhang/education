@extends('layouts.app')
@section('title','试卷添加')
@section('content')
@include('public.left')

<div class="layui-form-item">
    <label class="layui-form-label">试卷添加</label>
    <div class="layui-inline">
        <input type="text" name="test_name" lay-verify="title" autocomplete="off" placeholder="请添加试卷名称" class="layui-input">
    </div>
</div>
<div class="form-inline">
    试卷分类：
    <select name="type_id" class="p_id form-control" id="type1" style="width: auto;">
        <option value="">请选择支付方式</option>
        @foreach($type_info as $vv)
            <option class="type_id" value="{{$vv['type_id']}}">{{$vv['type']}}</option>
        @endforeach
    </select>
</div>
<center>
    <table class="layui-table table-bordered table-hover table-striped" border="1">
        <tr class="type">
            <td></td>
            <td>题目名称</td>
            <td>试卷分类</td>
        </tr>
        <tbody id=list>
        @foreach($data as $k=>$v)
        <tr id="{{$v['id']}}">
            <td> <input type="checkbox" name="q_id[]" value="{{$v['id']}}"></td>
            <td>{{$v['problem']}}</td>
            <td id="type2" type2="{{$v['type_id']}}">{{$v['type']}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        <input class="layui-btn" type="button" value="添加" id="btn">
    </div>
</center>
<script>
    $(document).on('change',"#type1",function () {
        $('#list').empty();
        // $('#list').hide();
        var type_id=$(this).val();
        $.get('create',{type_id:type_id},function(res){
            // console.log(res.data);
            $.each(res.data,function(i,v){
                var tr = $("<tr></tr>");
                tr.append("<td><input type='checkbox' name='q_id[]' value='"+v.id+"'></td>");
                tr.append("<td>"+v.problem+"</td>");
                tr.append("<td>"+v.type+"</td>");
                $('#list').append(tr);
            })
        },'json');
    })
    $(document).on('click',"#btn",function () {
        var q_id_array =[];//定义一个数组
        $('input[name="q_id[]"]:checked').each(function(){//遍历每一个名字为interest的复选框，其中选中的执行函数
            q_id_array.push($(this).val());//将选中的值添加到数组course_id_array中
        });
        // console.log(q_id_array);
        var test_name = $('input[name="test_name"]').val();
        var type_id=$('#type1').val();
        $.ajax({
            url:"{{url('test/store')}}",
            data:{q_id_array:q_id_array,test_name:test_name,type_id:type_id},
            type:"post",
            dataType:"json",
            success:function(res){
                if(res.code==200){
                    alert(res.msg);
                }
            }
        })
    })
</script>
@endsection