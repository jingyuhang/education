<?php

namespace App\Http\Controllers\test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Test;
use App\Model\Question_answer;
use App\Model\Question_problem;
use App\Model\Question_type;
class TestController extends Controller
{
    //试卷添加视图
    public function create(Request $request)
    {
        $type_id = $request->input(['type_id'])??'';
        if($type_id !=null){
            $where[]=['Question_problem.type_id','=',$type_id];
        }else{
            $where=[];
        }
        $type_info = Question_type::get()->toArray();
        $data = Question_problem::join('question_type','Question_problem.type_id','=','question_type.type_id')
                                ->where($where)
                                ->get()
                                ->toArray();
                            
          if($type_id !=null){
              echo json_encode(['data'=>$data]);die;
                 }else{
                    return view('test/test_create',['data'=>$data,'type_info'=>$type_info,'type_id'=>$type_id]);
               }
       
    }
    public function store(Request $request)
    {
        $ques_id =$request->input('q_id_array');
        $test_name = $request->input('test_name');
        $type_id = $request->input('type_id');
        // dd($ques_id);
        foreach($ques_id as $v){
            $res = Test::insert([
                'ques_id' => $v,
                'test_name'=>$test_name,
                'type_id'=>$type_id
            ]);
        }
        if($res){
            return json_encode(['code'=>200,'msg'=>"添加成功"]);
        }else{
            return json_encode(['code'=>201,'msg'=>"添加失败"]);
        }
    }

    public function test_show(Request $request)
    {
//        $data=$request->all();
        $type_id=$request->type_id;
//        dd($type_id);
//        $type_id=$data['type_id'];
        $where=[];

        if(!empty($type_id)){
            $where[]=['type_id','=',$type_id];
        }

        //查询题库
        $test_info=DB::table('test')->where($where)->paginate(2);
//        dd($test_info);
        return view('test/show',['test_info'=>$test_info,'type_id'=>$type_id]);
    }

    public function test_del(Request $request)
    {
        $test_id=$request->test_id;
//        dd($test_id);
        $test_del=DB::table('test')->where('test_id',$test_id)->delete();
        $url=url('TestController/test_show');
        if($test_del){
            echo "<script>alert('咨询删除成功');window.location.href='$url';</script>";
        }

    }
}