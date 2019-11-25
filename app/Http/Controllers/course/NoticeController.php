<?php

namespace App\Http\Controllers\course;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\NoticeModel;

class NoticeController extends Controller
{
    //添加公告页面
    public function create_notice_view()
    {
        //查询所有课程
        $course_info=DB::connection('shixun_2_ku')->table('course')
            ->get()->toArray();
        $course_info=json_decode(json_encode($course_info),true);
//        dd($course_info);
        return view('course/notice/create_notice',['course_info'=>$course_info]);
    }
    //执行添加公告
    public function create_notice(Request $request)
    {
        $data=$request->all();
        $course_id=$data['course_id'];
        $notice=$data['notice'];
//        dd($data);
        $notice_insert=DB::connection('shixun_2_ku')->table('notice')->insert([
            'course_id'=>$course_id,
            'notice'=>$notice,
            'create_time'=>time(),
        ]);
        if($notice_insert){
            echo json_encode(['code'=>1,'msg'=>'课程公告添加成功']);
        }else{
            echo json_encode(['code'=>2,'msg'=>'课程公告添加失败']);
        }
    }
    //公告展示页面
    public function notice_show_view(Request $request)
    {
        $course_id = $request->input('course_id');
        $data=$request->all();
//        dd($data);
        $where=[];
        //公告不为空
        if(!empty($data['notice']) && empty($data['course_id'])){
            $where[]=['notice.notice','like',"%".$data['notice']."%"];
            //课程不为空
        }elseif (!empty($data['course_id']) && empty($data['notice']))
        {
            $where[]=['notice.course_id','=',$data['course_id']];
            //都为空
        }elseif(empty($data['notice']) && empty($data['course_id'])){
            $where=[];
            //都不为空
        }else{
            $where[]=['notice.course_id','=',$data['course_id']];
            $where[]=['notice.notice','like',"%".$data['notice']."%"];
        }


        //两表联查 --课程表和课程公告表

        $course_notice=NoticeModel::join('course','notice.course_id','=','course.course_id')
            ->where('notice.course_id',$course_id)
            ->orWhere($where)
            ->paginate(3);
        //后台处理已删除未删除
        $is_del=[1=>'未删除',2=>'已删除'];
        // echo "<pre>";
        foreach ($course_notice as $k=> $v)
        {
            $course_notice[$k]['is_del']=$is_del[$v['is_del']];
        }

        return view("course/notice/show",['course_notice'=>$course_notice]);
    }

    //公告修改页面
    public function notice_update_view(Request $request)
    {
        $notice_id=$request->notice_id;
//        dd($notice_id);
        if(empty($notice_id)){
            exit;
        }
//        dd($notice_id);

        //查询所有课程
        //查询所有课程
        $course_info=DB::connection('shixun_2_ku')->table('course')
            ->get()->toArray();

        //两表联查 公告+课程
        $notice_info=NoticeModel::join('course','notice.course_id','=','course.course_id')
            ->where('notice_id',$notice_id)
            ->get();

//        DD($notice_info);die;
        return view('course/notice/update',['notice_info'=>$notice_info,'course_info'=>$course_info]);
    }

    //公告修改接口
    public function noticeupdate(Request $request)
    {
        $data=$request->all();
        if(!isset($data)){
            exit;
        }
//        dd($data);
        $notice_id=$data['notice_id'];
        $course_id=$data['course_id'];
        $notice=$data['notice'];
//        dd($data);
        $update_info=noticeModel::where('notice_id',$notice_id)->update([
            'notice'=>$notice,
            'course_id'=>$course_id,
        ]);
        if($update_info){
            echo json_encode(['code'=>1,'msg'=>'公告修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'公告修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    //公告删除接口
    public function noticedel(Request $request)
    {
        $notice_id=$request->notice_id;
        if(empty($notice_id)){
            exit;
        }
//        dd($notice_id);
        $del_result=noticeModel::where('notice_id',$notice_id)->update([
            'is_del'=>2
        ]);
        if($del_result){
            echo json_encode(['code'=>1,'msg'=>'删除成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'删除失败'],JSON_UNESCAPED_UNICODE);exit;
        }
    }
   
}
