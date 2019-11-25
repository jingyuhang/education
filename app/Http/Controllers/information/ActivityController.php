<?php

namespace App\Http\Controllers\information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ActivityModel;

class ActivityController extends Controller
{
    //精彩活动添加页面
    public function activity_add_view()
    {
        return view('activity/add');
    }
    //精彩活动添加接口
    public function activityadd(Request $request)
    {
        $data=$request->all();
//        dd($data);
        if(!isset($data)){
            exit;
        }
        $activity_title=$data['activity_title'];
        $activity_content=$data['activity_content'];
        $activity_num=$data['activity_num'];
//        dd($activity_num);
        $activity_add=ActivityModel::create([
            'activity_title'=>$activity_title,
            'activity_content'=>$activity_content,
            'activity_num'=>$activity_num,
            'activity_time'=>time(),
        ]);

        if($activity_add){
            echo json_encode(['code'=>1,'msg'=>'精彩活动添加成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'精彩活动添加失败'],JSON_UNESCAPED_UNICODE);
        }

    }
    //精彩活动指导展示页面
    public function activity_show(Request $request)
    {
        $data=$request->all();

//            dd($data);
            $sex_arr=[1=>'未删除',2=>'已删除'];
//        $activity_info=ActivityModel::get()->toarray();
//        $activity_info=ActivityModel::paginate(2)->toarray()['data'];

            $where=[];
            //活动标题不为空
            if(!empty($data['activity_title'])){
                $where[]=['activity_title','like',"%".$data['activity_title']."%"];
                //是否删除不为空
            }else{
                $where=[];
            }
//            dd($where);
            $activity_info=ActivityModel::where($where)->orWhere('is_del',1)->paginate(3);
//        dd($activity_info);
            // echo "<pre>";
            foreach ($activity_info as $k=> $v)
            {
                $activity_info[$k]['is_del']=$sex_arr[$v['is_del']];
            }


//        print_r($activity_info);die;
        return view("/activity/show",['activity_info'=>$activity_info]);
    }
    //精彩活动修改页面
    public function activity_update_view(Request $request)
    {
        $activity_id=$request->activity_id;
//        dd($activity_id);
        if(empty($activity_id)){
            exit;
        }
//        dd($activity_id);
        $activity_info=ActivityModel::where('activity_id',$activity_id)->get()->toarray();
//        dd($activity_info);
        return view('activity/update',['activity_info'=>$activity_info[0]]);
    }
    //精彩活动修改接口
    public function activityupdate(Request $request)
    {
        $data=$request->all();
        if(!isset($data)){
            exit;
        }
//        dd($data);
        $activity_id=$data['activity_id'];
        $activity_num=$data['activity_num'];
        $activity_title=$data['activity_title'];
        $activity_content=$data['activity_content'];
//        dd($data);
        $update_info=ActivityModel::where('activity_id',$activity_id)->update([
            'activity_title'=>$activity_title,
            'activity_content'=>$activity_content,
            'activity_num'=>$activity_num,
        ]);
        if($update_info){
            echo json_encode(['code'=>1,'msg'=>'精彩活动修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'精彩活动修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    //精彩活动删除接口
    public function activitydel(Request $request)
    {
        $activity_id=$request->activity_id;
        if(empty($activity_id)){
            exit;
        }
//        dd($activity_id);
        $del_result=ActivityModel::where('activity_id',$activity_id)->update([
            'is_del'=>2
        ]);
        if($del_result){
            echo json_encode(['code'=>1,'msg'=>'删除成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'删除失败'],JSON_UNESCAPED_UNICODE);exit;
        }
    }
}
