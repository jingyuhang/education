<?php

namespace App\Http\Controllers\Questions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Questions;
use App\Model\User;
use App\Model\Response;
use DB;
class QuestionsController extends Controller
{
	/**
	 * 问题添加接口
	 * @param Request $request [description]
	 */
	public function add(Request $request)
	{
		$data = $request->input();
		$res = Questions::insert([
			'u_id'=>1,
			'course_id'=>$data['course_id'],
			'q_title'=>$data['q_title'],
			'q_content'=>$data['q_content'],
			'q_browse'=>200,
			'q_time'=>time()
		]);
		if($res){
    		return json_encode(['code'=>200,'msg'=>'提问成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'提问失败']);
    	}
	}
	public function create()
    {
        return view('quesres.add');
    }

	/**
	 * 问题列表展示
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function list(Request $request)
    {

    	$quesData = DB::table('questions')->join('course','questions.course_id','=','course.course_id')->join('userdetail','questions.u_id','=','userdetail.u_id')->where('questions.is_del','=',1)->get()->toArray();
    	// print_r($quesData);die;
    	return view('quesres.list',['quesData'=>$quesData]);
    }

    /**
     * 问题删除
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function delete(Request $request)
    {
    	// echo 111;
    	$q_id = $request->input('q_id');
    	// var_dump($q_id);die;
    	$res = Questions::where('q_id',$q_id)->update([
    		'is_del' => 2
    	]);
    	
    	// var_dump($resluct);die;
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'删除成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'删除失败']);
    	}
    	
    }

    /**
     * 问题答复
     * @return [type] [description]
     */
	public function response()
	{
		return view('quesres.response');
	}

	/**
	 * 问题答复执行
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function response_do(Request $request)
    {
    	

    	$q_id = $request->input('q_id');
    	$r_content = $request->input('r_content');
    	// print_r($r_content);die;
    	$quesData = DB::table('questions')->join('course','questions.course_id','=','course.course_id')->join('userdetail','questions.u_id','=','userdetail.u_id')->where('questions.is_del','=',1)->get()->toArray();
    	// print_r($quesData);die;
    	$u_id = [];
    	$course_id = [];
    	foreach ($quesData as $key => $value) {
    		$u_id = $quesData[$key]->u_id;
    		$course_id = $quesData[$key]->course_id;
    	}
    	// print_r($course_id);die;
    	$res = DB::table('response')->insert([
    		'u_id'=>$u_id,
    		'course_id'=>$course_id,
    		'q_id'=>$q_id,
    		'r_content'=>$r_content,
    		'r_time'=>time()
    	]);
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'回答成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'回答失败']);
    	}
    }

    /**
     * 问题答复列表展示
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function response_list(Request $request)
    {
    	$quesData = DB::table('questions')->join('course','questions.course_id','=','course.course_id')->join('userdetail','questions.u_id','=','userdetail.u_id')->join('response','questions.q_id','=','response.q_id')->where('response.is_del','=',1)->get()->toArray();
    	// print_r($quesData);die;
    	return view('quesres.response_list',['quesData'=>$quesData]);
    }

    /**
     * 答复删除
     */
    public function response_del(Request $request)
    {
    	$r_id = $request->input('r_id');
    	// var_dump($q_id);die;
    	$res = Response::where('r_id',$r_id)->update([
    		'is_del' => 2
    	]);
    	
    	// var_dump($resluct);die;
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'删除成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'删除失败']);
    	}
    }

    /**
     * 答复修改
     */
    public function response_edit(Request $request)
    {
    	$r_id = $request->input('r_id');
    	// var_dump($r_id);die;
    	$resData =  Response::where('r_id',$r_id)->get()->toArray();
    	// print_r($resData);die;

    	return view('quesres.response_edit',['resData'=>$resData]);
    }

    /**
     * 答复修改执行
     */
    public function response_save(Request $request)
    {
    	$data = $request->input();
    	// print_r($data);die;
    	$res = Response::where('r_id',$data['r_id'])->update([
    		'r_content'=>$data['r_content'],
    		'r_time'=>time()
    	]);
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'修改成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'修改失败']);
    	}
    }
}
