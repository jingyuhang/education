<?php

namespace App\Http\Controllers\course;

use App\Http\Controllers\Controller;
use App\Model\CollectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\FavoriteModel;


class CollectController extends Controller
{
//        public $u_id=20148024;
//    public function __construct(u_id $u_id)
//    {
//        $u_id=20148024;
//        $this->u_id=$u_id;
//    }
   // +++++++++++加入收藏+++++++++++++++
    //查询课程
    public function select_course()
    {
        $course_info= DB::table('course')
            ->get()->toArray();
        $course_info=json_decode(json_encode($course_info),true);
//        dd($course_info);
        return view('collect/course_show',['course_info'=>$course_info]);
    }
    //生成收藏夹页面
    public function create_favorite_view(Request $request)
    {
        $course_id=$request->course_id;
        $user_id=$request->user_id;

        //查询属于该用户的收藏夹
        $favorite_info=DB::table('favorite')->where('u_id',$user_id)->get()->toArray();
        $favorite_info=json_decode(json_encode($favorite_info),true);
        if(!empty($favorite_info)){
            //显示原有的收藏夹 并且可以创建新的收藏夹
            return view('collect/favorite_show',['user_id'=>$user_id,'course_id'=>$course_id,'favorite_info'=>$favorite_info]);
        }else{
            //去创建新的收藏夹
            return view('collect/create_favorite',['user_id'=>$user_id,'course_id'=>$course_id]);
        }



    }
    //已有收藏夹再新建一个收藏夹
    public function create_favorite_view_1(Request $request)
    {
        $course_id=$request->course_id;
        $user_id=$request->user_id;

        return view('collect/create_favorite',['user_id'=>$user_id,'course_id'=>$course_id]);




    }
    //加入收藏夹
    public function create_favorite(Request $request)
    {
        $data=$request->all();
       dd($data);
//        echo 1;
        $user_id=$data['user_id'];
        $course_id=$data['course_id'];
        $favorite_name=$data['favorite_name'];
//        dd($favorite_name);
        $favorite_insert=DB::table('favorite')->insert([
            'u_id'=>$user_id,
            'favorite_name'=>$favorite_name
        ]);
        if($favorite_insert){
            echo json_encode(['code'=>1,'msg'=>'收藏夹添加成功','course_id'=>$course_id,'u_id'=>$user_id]);
        }else{
            echo json_encode(['code'=>2,'msg'=>'收藏夹添加失败']);
        }
    }
    //生成收藏页面
    public function create_collect_view(Request $request)
    {
        //查询所有属于该用户的收藏夹
        $course_id=$request->course_id;
        $u_id=$request->user_id;
//        $u_id=$_SESSION['user_id'];
//        dd($course_id);
        $favorite_info=DB::table('favorite')
            ->where('u_id',$u_id)
            ->orderBy('favorite_id','desc')
            ->get()->toArray();
        $favorite_info=json_decode(json_encode($favorite_info),true);
//        dd($favorite_info);
        return view('collect/create_collect',['course_id'=>$course_id,'favorite_info'=>$favorite_info,'u_id'=>$u_id]);
    }
    //加入收藏
    public function create_collect(Request $request)
    {
        //bug1 新建收藏夹收藏可以 原有的收藏夹收藏不了
        $data=$request->all();
//        dd($data);
        $u_id=$data['u_id'];
        $favorite_id=$data['favorite_id'];
        $course_id=$data['course_id'];
//        dd($course_id);
        //加入收藏
        $collect_insert=DB::table('collect')->insert([
            'u_id'=>$u_id,
            'favorite_id'=>$favorite_id,
            'course_id'=>$course_id,
            'create_time'=>time(),
        ]);
//        dd($collect_insert);
        //将收藏夹表的收藏数量加一
        //查出该用户的收藏夹收藏的数量
        $favorite_num=DB::table('collect')->where('favorite_id',$favorite_id)->count('favorite_id');

//        dd($favorite_num);
        //根据收藏夹id修改收藏数量
        $favorite_update=FavoriteModel::where('favorite_id',$favorite_id)->update([
            'favorite_num'=>$favorite_num
        ]);
//        dd($favorite_update);
//        dd($favorite_id);
        if($collect_insert && $favorite_update){
            echo json_encode(['code'=>1,'msg'=>'收藏该课程成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'收藏该课程失败']);
        }

    }
    //++++++++++收藏夹增删改查+++++++++++++
    //收藏夹指导展示页面
    public function favorite_list(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $where=[];
        //活动标题不为空
        if(!empty($data['favorite_name']) && empty($data['u_id'])){
            $where[]=['favorite_name','like',"%".$data['favorite_name']."%"];
            //是否删除不为空
        }elseif (!empty($data['u_id']) && empty($data['favorite_name']))
        {
            $where[]=['u_id','=',$data['u_id']];
            //都不为空
        }elseif(empty($data['favorite_name']) && empty($data['u_id'])){
            $where=[];
        }else{
            $where[]=['u_id','=',$data['u_id']];
            $where[]=['favorite_name','=',$data['favorite_name']];
        }
//            dd($where);
        $favorite_info=FavoriteModel::join('collect','favorite.favorite_id','=','collect.favorite_id')->where($where)->paginate(3);

//        print_r($activity_info);die;
        return view("collect/favorite_list",['favorite_info'=>$favorite_info]);
    }
    //收藏夹修改页面
    public function favorite_update_view(Request $request)
    {
        $favorite_id=$request->favorite_id;
//        dd($favorite_id);
        if(empty($favorite_id)){
            exit;
        }
//        dd($favorite_id);
        $favorite_info=FavoriteModel::where('favorite_id',$favorite_id)->get()->toarray();
//        dd($favorite_info);
        return view('collect/favorite_update',['favorite_info'=>$favorite_info[0]]);
    }
    //收藏夹修改接口
    public function favoriteupdate(Request $request)
    {
        $data=$request->all();
        if(!isset($data)){
            exit;
        }
//        dd($data);
        $favorite_id=$data['favorite_id'];
        $favorite_num=$data['favorite_num'];
        $favorite_name=$data['favorite_name'];
        $u_id=$data['u_id'];
//        dd($data);
        $update_info=FavoriteModel::where('favorite_id',$favorite_id)->update([
            'favorite_name'=>$favorite_name,
            'u_id'=>$u_id,
            'favorite_num'=>$favorite_num,
        ]);
        if($update_info){
            echo json_encode(['code'=>1,'msg'=>'收藏夹修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'收藏夹修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    //收藏夹删除接口
    public function favoritedel(Request $request)
    {
        $favorite_id=$request->favorite_id;
        if(empty($favorite_id)){
            exit;
        }
//        dd($favorite_id);
        $del_result=FavoriteModel::where('favorite_id',$favorite_id)->update([
            'is_del'=>2
        ]);
        $url=url('InformationController/informationshow');
        if($del_result){

            echo "<script>alert('收藏删除成功');window.location.href='$url';</script>";
        }else{
            echo "<script>alert('收藏删除失败');window.location.href='$url';</script>";
        }
    }
    //+++++++++++++收藏表的增删改查++++++++++++++++++++++

    //收藏表的展示页面 搜索加分页 没有bug
    public function collect_list(Request $request)
    {
//        session_start();
        $u_id=1;

//        dd($u_id);
        $data=$request->all();
        $favrite_name=$request->get('favorite_name');//接收到的收藏夹名称
        $course_name=$request->get('course_name');//接收到的收藏夹名称
//        dd($favrite_name);

        $where=[];
        //收藏夹不为空
        if(!empty($data['favorite_name']) && empty($data['course_name'])){
            $where[]=['favorite.favorite_name','like',"%".$data['favorite_name']."%"];
            //课程名称不为空
        }elseif (!empty($data['course_name']) && empty($data['favorite_name']))
        {
            $where[]=['course.course_name','like',"%".$data['course_name']."%"];
            //都为空
        }elseif(empty($data['favorite_name']) && empty($data['course_name'])){
            $where=[];
            //都不为空
        }else{
            $where[]=['course.course_name','like',"%".$data['course_name']."%"];
            $where[]=['favorite.favorite_name','like',"%".$data['favorite_name']."%"];
        }
//            dd($where);
//        $collect_info=CollectModel::where($where)->paginate(3);
        //两表联查 --课程表和课程公告表

        $collect_info=CollectModel::join('favorite','collect.favorite_id','=','favorite.favorite_id')
            ->join('course','collect.course_id','=','course.course_id')
            ->where($where)
            ->where('collect.u_id',$u_id)
            ->paginate(1);


//        print_r($activity_info);die;
//        return view("/collect/collect_list",['collect_info'=>$collect_info]);
        return view("collect/collect_list",['collect_info'=>$collect_info,'favorite_name'=>$favrite_name,'course_name'=>$course_name]);
    }
    //收藏表的修改页面
    public function collect_update_view(Request $request)
    {
        $u_id=1;
        $collect_id=$request->collect_id;
//        dd($collect_id);
        if(empty($collect_id)){
            exit;
        }
//        dd($favorite_id);
        $course_info=DB::table('course')
            ->get()->toArray();

        $favorite_info=DB::connection('shixun_2_ku')->table('favorite')
            ->get()->toArray();

        $collect_info=CollectModel::join('favorite','collect.favorite_id','=','favorite.favorite_id')
            ->join('course','collect.course_id','=','course.course_id')
            ->where('collect.u_id',$u_id)
            ->where('collect.collect_id',$collect_id)
            ->paginate(1);
//        dd($collect_info);
        return view('collect/collect_update',['collect_info'=>$collect_info,'course_info'=>$course_info,'favorite_info'=>$favorite_info]);
    }
    //收藏表的修改接口
    public function collectupdate(Request $request)
    {
        $data=$request->all();
        if(!isset($data)){
            exit;
        }
//        dd($data);
        $favorite_id=$data['favorite_id'];
        $collect_id=$data['collect_id'];
        $course_id=$data['course_id'];
        $u_id=$data['u_id'];
//        dd($data);
        $update_info=CollectModel::where('collect_id',$collect_id)->where('u_id',$u_id)->update([
            'favorite_id'=>$favorite_id,
            'course_id'=>$course_id,
        ]);
        if($update_info){
            echo json_encode(['code'=>1,'msg'=>'收藏修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'收藏修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    //收藏表的删除接口
    public function collectdel(Request $request)
    {
        $collect_id=$request->collect_id;
        $u_id=$request->u_id;
//        dd($collect_id);
        if(empty($collect_id)){
            exit;
        }
//        dd($favorite_id);
        $del_result=CollectModel::where('collect_id',$collect_id)->where('u_id',$u_id)->update([
            'is_del'=>2
        ]);
        if($del_result){
//            echo json_encode(['code'=>1,'msg'=>'删除成功'],JSON_UNESCAPED_UNICODE);
            echo "<script>alert('收藏删除成功');history.go(-1);location.reload();</script>";
        }else{
            echo "<script>alert('收藏删除失败');history.go(-1);location.reload();</script>";
        }
    }
}
