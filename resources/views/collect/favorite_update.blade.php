@extends('layouts.app')
@section('content')
@include('public.left')
    <form>
        <div class="form-inline">
            <label for="favoritepleInputEmail1" ><b style="font-size: 18px;color: blue">收藏夹内容</b></label>
            <input type="text"  name="favorite_name" class="form-control favorite_name"  placeholder="收藏夹内容" style="width: auto" value="{{$favorite_info['favorite_name']}}">
        </div>

        <div class="form-inline">
            <label for="favoritepleInputEmail1" ><b style="font-size: 18px;color: blue">用户id</b></label>
            <input type="text"  name="u_id" class="form-control u_id"  placeholder="用户id" style="width: auto" value="{{$favorite_info['u_id']}}">
        </div>

        <div class="form-inline">
            <label for="favoritepleInputEmail1" ><b style="font-size: 18px;color: blue">收藏数量</b></label>
            <input type="number"  name="favorite_num" class="form-control favorite_num"  placeholder="浏览次数" style="width: auto" value="{{$favorite_info['favorite_num']}}">
        </div>
        <input type="hidden" name="favorite_id" id="favorite_id" value="{{$favorite_info['favorite_id']}}">
        <input type="button" value="修改收藏夹" class="favorite_edit form-group">

    </form>

    <script>
        $(document).on("click",".favorite_edit",function () {
            var favorite_name=$("input.favorite_name").val();
            var u_id=$(".u_id").val();
            var favorite_num=$(".favorite_num").val();
            var favorite_id=$("#favorite_id").val();
            var url="{{asset('CollectController/favoriteupdate')}}";

//            return;
            $.ajax({
                url:url,
                data: {favorite_name: favorite_name, u_id: u_id,favorite_num:favorite_num,favorite_id:favorite_id},
                type: 'post',
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                    if(res.code==1){
//
                        wjl_confirm();
                    }else{
                        alert(res.msg);
                        window.history.go(-1);
                    }
                }
            })

        });

        //确定取消框
        function wjl_confirm(){
            var msg=confirm('收藏夹修改成功是否返回收藏夹列表');
            if(msg==true){
                window.location.href="{{url('CollectController/favorite_list')}}";
            }else{
                window.location.href(-1);
            }
        }


    </script>


@endsection