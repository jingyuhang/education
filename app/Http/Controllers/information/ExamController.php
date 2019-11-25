<?php

namespace App\Http\Controllers\information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\ExamModel;

class ExamController extends Controller
{
    //考试添加页面
    public function exam_add_view()
    {
        return view('exam/add');
    }
    //考试添加接口
    public function examadd(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $exam_title=$data['exam_title'];
        $exam_content=$data['exam_content'];
        $exam_num=$data['exam_num'];
//        dd($exam_num);
        $exam_add=ExamModel::create([
            'exam_title'=>$exam_title,
            'exam_content'=>$exam_content,
            'exam_num'=>$exam_num,
            'exam_time'=>time(),
        ]);

        if($exam_add){
            echo json_encode(['code'=>1,'msg'=>'考试添加成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'考试添加失败'],JSON_UNESCAPED_UNICODE);
        }

    }
    //考试指导展示页面
    public function exam_show(Request $request)
    {
//        $sex_arr=[1=>'未删除',2=>'已删除'];
//        $exam_info=ExamModel::get()->toarray();
//        echo "<pre>";
//        foreach ($exam_info as $k=> $v)
//        {
//            $exam_info[$k]['is_del']=$sex_arr[$v['is_del']];
//        }
////        print_r($exam_info);die;
//        return view("/exam/show",['exam_info'=>$exam_info]);

        $exam_title=$request->get('exam_title');
        $exam_content=$request->get('exam_content');
//            dd($exam_content);
        $sex_arr=[1=>'未删除',2=>'已删除'];

        $where=[];
        //咨询标题不为空
        if(!empty($exam_title) && empty($exam_content)){
            $where[]=['exam_title','like',"%".$exam_title."%"];
            //资讯内容不为空
        }elseif (!empty($exam_content) && empty($exam_title))
        {
            $where[]=['exam_content','like',"%".$exam_content."%"];
            //都为空
        }elseif(empty($exam_content) && empty($exam_title)){
            $where=[];
            //都不为空
        }else{
//            $where[]=['is_del','=',$data['is_del']];
            $where[]=['exam_content','like',"%".$exam_content."%"];
            $where[]=['exam_title','like',"%".$exam_title."%"];
        }
//            dd($where);
        $exam_info=examModel::where($where)->orWhere('is_del',1)->paginate(1);
//        dd($exam_info);
        // echo "<pre>";
        foreach ($exam_info as $k=> $v)
        {
            $exam_info[$k]['is_del']=$sex_arr[$v['is_del']];
        }


//        print_r($exam_info);die;
        return view("exam/show",['exam_info'=>$exam_info,'exam_content'=>$exam_content,'exam_title'=>$exam_title]);
    }
    //考试修改页面
    public function exam_update_view(Request $request)
    {
        $exam_id=$request->exam_id;
//        dd($exam_id);
        $exam_info=ExamModel::where('exam_id',$exam_id)->get()->toarray();
//        dd($exam_info);
        return view('exam/update',['exam_info'=>$exam_info[0]]);
    }
    //考试修改接口
    public function examupdate(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $exam_id=$data['exam_id'];
        $exam_num=$data['exam_num'];
        $exam_title=$data['exam_title'];
        $exam_content=$data['exam_content'];
//        dd($data);
        $update_info=ExamModel::where('exam_id',$exam_id)->update([
            'exam_title'=>$exam_title,
            'exam_content'=>$exam_content,
            'exam_num'=>$exam_num,
        ]);
        if($update_info){
            echo json_encode(['code'=>1,'msg'=>'考试修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'考试修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    //考试删除接口
    public function examdel(Request $request)
    {
        $exam_id=$request->exam_id;
//        dd($exam_id);
        $del_result=ExamModel::where('exam_id',$exam_id)->update([
            'is_del'=>2
        ]);
        if($del_result){
            echo json_encode(['code'=>1,'msg'=>'删除成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'删除失败'],JSON_UNESCAPED_UNICODE);exit;
        }
    }
}
