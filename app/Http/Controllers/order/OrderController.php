<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //创建订单
    public function create_order_view()
    {
        //查课程
        $course_info=DB::table('course')->get()->toarray();
        $course_info=json_decode(json_encode($course_info),true);
//        dd($course_info);
        //查支付方式
        $pay_info=DB::table('pay_method')->get()->toarray();
        $pay_info=json_decode(json_encode($pay_info),true);
//        dd($pay_info);
        return view('order/add',['course_info'=>$course_info,'pay_info'=>$pay_info]);
    }

    //订单添加接口
    public function create_order(Request $request)
    {
        $data=$request->all();
//        dd($data);
        if(!isset($data)){
            exit;
        }
        $course_id=$data['course_id'];
        $pay_id=$data['p_id'];
        $u_id=$data['u_id'];
        $pay_status=$data['pay_status'];
        $order_mark=$data['order_mark'];
        $pay_price=$data['pay_price'];
//        dd($order_num);
        $order_add=DB::table('order')->insertGetId([
            'course_id'=>$course_id,
            'pay_id'=>$pay_id,
            'u_id'=>$u_id,
            'pay_status'=>$pay_status,
            'order_mark'=>$order_mark,
            'pay_price'=>$pay_price,
        ]);

        if($order_add){
            echo json_encode(['code'=>1,'msg'=>'订单添加成功','order_id'=>$order_add],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'订单添加失败'],JSON_UNESCAPED_UNICODE);
        }

    }
    //订单指导展示页面
    public function order_show(Request $request)
    {
        $data=$request->all();

//            dd($data);
        $course_id=$request->get('course_id');
        $order_mark=$request->get('order_mark');
//        dd($course_id);
        $where=[];
        //课程不为空
        if(!empty($data['course_id']) && empty($data['order_mark'])){
            $where[]=['course.course_id','=',$data['course_id']];
            //订单编号不为空
        }elseif (!empty($data['order_mark']) && empty($data['course_id']))
        {
            $where[]=['order.order_mark','like','%'.$data['order_mark'].'%'];
            //都为空
        }elseif(empty($data['course_id']) && empty($data['order_mark'])){
            $where=[];
        }else{
            //都不为空
            $where[]=['order.order_mark','like','%'.$data['order_mark'].'%'];
            $where[]=['course.course_id','=',$data['course_id']];
        }
//            dd($where);

        //查课程
        $course_info=DB::table('course')->get()->toarray();
        $course_info=json_decode(json_encode($course_info),true);

        $order_info = DB::table('order')
            ->join('pay_method', 'order.pay_id', '=', 'pay_method.pay_id')
            ->join('course', 'order.course_id', '=', 'course.course_id')
            ->where($where)
            ->orderBy('order.order_id','desc')
            ->paginate(1);

//        print_r($order_info);die;
        return view("order/show",['order_info'=>$order_info,'course_info'=>$course_info,'course_id'=>$course_id,'order_mark'=>$order_mark]);
    }
//    //订单修改页面
//    public function order_update_view(Request $request)
//    {
//        $order_id=$request->order_id;
////        dd($order_id);
//        if(empty($order_id)){
//            exit;
//        }
////        dd($order_id);
//        $order_info=orderModel::where('order_id',$order_id)->get()->toarray();
////        dd($order_info);
//        return view('order/update',['order_info'=>$order_info[0]]);
//    }
//    //订单修改接口
//    public function orderupdate(Request $request)
//    {
//        $data=$request->all();
//        if(!isset($data)){
//            exit;
//        }
////        dd($data);
//        $order_id=$data['order_id'];
//        $order_num=$data['order_num'];
//        $course_id=$data['course_id'];
//        $order_content=$data['order_content'];
////        dd($data);
//        $update_info=orderModel::where('order_id',$order_id)->update([
//            'course_id'=>$course_id,
//            'order_content'=>$order_content,
//            'order_num'=>$order_num,
//        ]);
//        if($update_info){
//            echo json_encode(['code'=>1,'msg'=>'订单修改成功'],JSON_UNESCAPED_UNICODE);
//        }else{
//            echo json_encode(['code'=>0,'msg'=>'订单修改失败'],JSON_UNESCAPED_UNICODE);
//        }
//    }
    //订单删除接口
    //删除订单
    public function orderdel(Request $request)
    {
        $order_id=$request->order_id;
        if(empty($order_id)){
            exit;
        }
//        dd($order_id);
        $del_result=DB::table('order')->where('order_id',$order_id)->update([
            'order_mark'=>2
        ]);
        $url=url('OrderController/order_show');
        if($del_result){

            echo "<script>alert('订单删除成功');window.location.href='$url';</script>";
        }else{
            echo "<script>alert('订单删除失败');window.location.href='$url';</script>";
        }
    }

    //添加订单详情的视图
    public function create_detail_view(Request $request)
    {
        $data=$request->all();
//        dd($order_id);
        $order_id=$data['order_id'];

        $u_id=$data['u_id'];
//        dd($u_id);

//        dd($order_id);
//        $order_id=1;
        //查课程
        $course_info=DB::table('course')->get()->toarray();
        $course_info=json_decode(json_encode($course_info),true);
//        dd($course_info);
        //查讲师
        $teacher_info=DB::table('teacher')->get()->toarray();
        $teacher_info=json_decode(json_encode($teacher_info),true);

//        $teacher_info['order_id']=$order_id;
//        dd($teacher_info);
//        foreach ($teacher_info as $k => $value){
//            $teacher_info[$k]['order_id']=$order_id;
//        }
//        dd($teacher_info);
        return view('order/detail_add',['course_info'=>$course_info,'teacher_info'=>$teacher_info,'order_id'=>$order_id,'u_id'=>$u_id]);
    }

    //添加订单详情
    public function create_detail(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $course_id=$data['course_id'];
        $lect_id=$data['lect_id'];
        $course_price=$data['course_price'];
        $is_free=$data['is_free'];
        $order_id=$data['order_id'];
        $u_id=$data['u_id'];

        //判断是否上传文件
        if($request->file('detail_photo')!=''){
            $date=date('Y-n-j',time());
//        dd($date);
//            $path=storage_path("app\public");
            $detail_photo_path = $request->file('detail_photo')->store('video\\'.$date.'\\');

//            dd($information_photo_path);
//            $path_new=$path.'\\'.$information_photo_path;
//            dd($path_new);
//            D:\wnmp\www\education\storage\app\public\image\2019-11-22\51BO8snCAMu0adoI3cpNMOkgNVJPocjGiw9ByVgf.jpeg
            //有图片添加
            $information_add=DB::table('detail')->insert([
                'course_id'=>$course_id,
                'lect_id'=>$lect_id,
                'course_price'=>$course_price,
                'is_free'=>$is_free,
                'order_id'=>$order_id,
                'u_id'=>$u_id,
                'create_time'=>time(),
                'video'=>$detail_photo_path,
            ]);//返回的是一个包含商品ID的对象
        }else{
//            dd(1);
            //不加图片添加
            $information_add=DB::table('detail')->insert([
                'course_id'=>$course_id,
                'lect_id'=>$lect_id,
                'course_price'=>$course_price,
                'order_id'=>$order_id,
                'u_id'=>$u_id,
                'is_free'=>$is_free,
                'create_time'=>time(),
            ]);//返回的是一个包含商品ID的对象
        }


        if($information_add){
            echo json_encode(['code'=>1,'msg'=>'订单详情添加成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'订单详情添加失败'],JSON_UNESCAPED_UNICODE);
        }

    }
    //订单详情展示
    public function detail_show(Request $request)
    {
        $data=$request->all();
//            dd($data);
        //搜索用的接值
        $course_id=$request->get('course_id');
        $lect_id=$request->get('lect_id');

        $order_id=$request->order_id;
        $u_id=$request->u_id;
//        dd($order_id);
        $where=[];
        //课程不为空
        if(!empty($data['course_id']) && empty($data['lect_id'])){
            $where[]=['course.course_id','=',$data['course_id']];
            $where[]=['detail.order_id','=',$order_id];
            $where[]=['detail.u_id','=',$u_id];

            //订单编号不为空
        }elseif (!empty($data['lect_id']) && empty($data['course_id']))
        {
            $where[]=['detail.lect_id','like','%'.$data['lect_id'].'%'];
            $where[]=['detail.order_id','=',$order_id];
            $where[]=['detail.u_id','=',$u_id];
            //都为空
        }elseif(empty($data['course_id']) && empty($data['lect_id'])){
            $where=[];
            $where[]=['detail.order_id','=',$order_id];
            $where[]=['detail.u_id','=',$u_id];
        }else{
            //都不为空
            $where[]=['detail.lect_id','like','%'.$data['lect_id'].'%'];
            $where[]=['course.course_id','=',$data['course_id']];
            $where[]=['detail.order_id','=',$order_id];
            $where[]=['detail.u_id','=',$u_id];
        }
//            dd($where);

        //查课程
        $course_info=DB::table('course')->get()->toarray();
        $course_info=json_decode(json_encode($course_info),true);

        //查讲师
        $teacher_info=DB::table('teacher')->get()->toarray();
        $teacher_info=json_decode(json_encode($teacher_info),true);


        $detail_info = DB::table('detail')
            ->join('teacher', 'detail.lect_id', '=', 'teacher.lect_id')
            ->join('course', 'detail.course_id', '=', 'course.course_id')
            ->where($where)
            ->orderBy('detail.detail_id','desc')
            ->paginate(1);
//        $detail_info=json_decode(json_encode($detail_info),true);
//        dd($detail_info);die;
            return view("order/detail_show",['detail_info'=>$detail_info,'course_info'=>$course_info,'teacher_info'=>$teacher_info,'course_id'=>$course_id,'lect_id'=>$lect_id]);
    }
    //订单详情修改页面
    public function detail_update_view(Request $request)
    {
        $detail_id=$request->detail_id;

//        $order_id=1;
        //查课程
        $course_info=DB::table('course')->get()->toarray();
        $course_info=json_decode(json_encode($course_info),true);
//        dd($course_info);
        //查讲师
        $teacher_info=DB::table('teacher')->get()->toarray();
        $teacher_info=json_decode(json_encode($teacher_info),true);

        //查询该详情的信息
        $detail_info=DB::table('detail')->where('detail_id',$detail_id)->get();
//        dd($detail_info);
        return view('order/detail_update',['course_info'=>$course_info,'teacher_info'=>$teacher_info,'detail_info'=>$detail_info]);
    }
    //订单详情修改
    public function detail_update(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $course_id=$data['course_id'];
        $lect_id=$data['lect_id'];
        $course_price=$data['course_price'];
        $is_free=$data['is_free'];
        $detail_id=$data['detail_id'];

        //判断是否上传文件
        if($request->file('detail_photo')!=''){
            $date=date('Y-n-j',time());
//        dd($date);
//            $path=storage_path("app\public");
            $detail_photo_path = $request->file('detail_photo')->store('video\\'.$date.'\\');

//            dd($information_photo_path);
//            $path_new=$path.'\\'.$information_photo_path;
//            dd($path_new);
//            D:\wnmp\www\education\storage\app\public\image\2019-11-22\51BO8snCAMu0adoI3cpNMOkgNVJPocjGiw9ByVgf.jpeg
            //有图片添加
            $information_add=DB::table('detail')->where('detail_id',$detail_id)->update([
                'course_id'=>$course_id,
                'lect_id'=>$lect_id,
                'course_price'=>$course_price,
                'is_free'=>$is_free,
                'video'=>$detail_photo_path,
            ]);//返回的是一个包含商品ID的对象
        }else{
//            dd(1);
            //不加图片添加
            $information_add=DB::table('detail')->where('detail_id',$detail_id)->update([
                'course_id'=>$course_id,
                'lect_id'=>$lect_id,
                'course_price'=>$course_price,
                'is_free'=>$is_free,
            ]);//返回的是一个包含商品ID的对象
        }


        if($information_add){
            echo json_encode(['code'=>1,'msg'=>'订单详情修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'订单详情修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    //订单详情中查看用户详情
    public function select_user_detail(Request $request)
    {
        $detail_id=$request->detail_id;
//        dd($detail_id);
        //查询该详情的信息
        $u_id=DB::table('detail')->where('detail_id',$detail_id)->value('u_id');
//        dd($user_id);
        //拿u_id去用户详情查询
        $user_info=DB::table('userdetail')->where('u_id',$u_id)->get()->toArray();
//        dd($user_info);
        return view('order/user_detail',['u_info'=>$user_info]);

    }

    public function select_teacher_detail(Request $request)
    {
        $detail_id=$request->detail_id;
//        dd($detail_id);
        //查询该详情的信息
        $lect_id=DB::table('detail')->where('detail_id',$detail_id)->value('lect_id');
//        dd($user_id);
        //拿u_id去用户详情查询
        $lecturer_info=DB::table('teacher')->where('lect_id',$lect_id)->get()->toArray();
//        dd($lecturer_info);
        return view('order/teacher_detail',['lecturer_info'=>$lecturer_info]);

    }
    //订单详情中查看讲师详情
    public function select_course_detail(Request $request)
    {
        $detail_id=$request->detail_id;
//        dd($detail_id);
        //查询该详情的信息
        $course_id=DB::table('detail')->where('detail_id',$detail_id)->value('course_id');
//        dd($user_id);
        //拿u_id去用户详情查询
        $course_info=DB::table('course')->where('course_id',$course_id)->get()->toArray();

        $course_info = DB::table('course')
            ->join('teacher', 'course.lect_id', '=', 'teacher.lect_id')
            ->where('course_id',$course_id)
            ->get()
            ->toArray();
//        dd($course_info);
        return view('order/course_detail',['course_info'=>$course_info]);

    }
}
