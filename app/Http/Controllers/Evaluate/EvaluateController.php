<?php

namespace App\Http\Controllers\Evaluate;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Evaluate;
use DB;
class EvaluateController extends Controller
{
	/**
	 * 发表评论接口
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function course_evaluate_add(Request $request)
    {
    	$data = $request->input();
    	$res = Evaluate::insert([
    		'course_id'=>$data['course_id'],
    		'u_id'=>1,
    		'evaluate_desc'=>$data['evaluate_desc'],
    		'evaluate_num'=>200,
    		'create_time'=>time()
    	]);
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'评价成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'评价失败']);
    	}
    }

    /**
     * 评论列表展示
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function course_evaluate_list(Request $request)
    {
		$course_id = $request->input('course_id');
		$evaData = DB::table('evaluate')
					->join('course','evaluate.course_id','=','course.course_id')
					->join('userdetail','evaluate.u_id','=','userdetail.u_id')
					->where('evaluate.course_id',$course_id)
					->orWhere('evaluate.is_del','=',1)
					->get()->toArray();
    	// print_r($evaData);die;
    	return view('evaluate.course_evaluate_list',['evaData'=>$evaData]);
    }

    public function course_evaluate_del(Request $request)
    {
    	$evaluate_id = $request->input('evaluate_id');
    	$res = Evaluate::where('evaluate_id',$evaluate_id)->update([
    		'is_del' => 2
    	]);
    	
    	// var_dump($resluct);die;
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'删除成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'删除失败']);
    	}
    }

}
