<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Teacher;
use DB;
use App\Model\Profit;
class TeacherController extends Controller
{
    public function teacher_add_index(Request $request)
    {
    	$cateData = Category::get()->toArray();
    	$cateData = $this->info($cateData);
    	// var_dump($pData);die;
    	return view('teacher.teacher_add',['cateData'=>$cateData]);
    }
    public function info($data,$pid=0,$level=1)
    {
    	static $arr = [];
    	foreach($data as $v){
    		if($v['pid'] == $pid){
    			$arr[] = $v;
    			$this->info($data,$v['cate_id'],$level+1);
    		}
    	}
    	return $arr;
    }

    public function teacher_add(Request $request)
    {
    	// echo 1111;die;
    	$data = $request->input();
    	$image = $request->input('image');
        // var_dump($image);die;
        $n = strpos($image,',');
        $str = substr($image, $n+1);
        $str = base64_decode($str);
        // var_dump($str);die;
        $ext = $this->check_image_type($str);
        $ext = strtolower($ext);

        $imageName = md5(time().rand(1000,9999)).'.'.$ext;
        // print_r($imageName);die;
        $date = date("Y-n-j");
        if(!file_exists("./images/".$date)){ 
            mkdir("./images/".$date,0700);
        }
        $imageSrc = "./images/".$date."/". $imageName;
        $images = substr($imageSrc,1);
        $r = file_put_contents($imageSrc, $str);
		
    	$res = Teacher::insert([
    		'lect_name'=>$data['lect_name'],
    		'lect_resume'=>$data['lect_resume'],
    		'lect_style'=>$data['lect_style'],
    		'cate_id'=>$data['cate_id'],
    		'image'=>$images
    	]);
    	if($res) 
    			return json_encode(['code'=>200,'msg'=>'讲师添加成功!']);
    		else 
    			return json_encode(['code'=>201,'msg'=>'讲师添加失败!']);
    }

    public function check_image_type($image)
    {
        $bits = array(
            'JPEG' => "\xFF\xD8\xFF",
            'GIF' => "GIF",
            'PNG' => "\x89\x50\x4e\x47\x0d\x0a\x1a\x0a",
            'BMP' => 'BM',
        );
        foreach ($bits as $type => $bit) {
            if (substr($image, 0, strlen($bit)) === $bit) {
                return $type;
            }
        }
        return 'UNKNOWN IMAGE TYPE';
    }

    public function teacher_list(Request $request)
    {
    	
    	$teaData = Category::join('teacher','category.cate_id','=','teacher.cate_id')->where('teacher.is_del','=',1)->orderBy('teacher.lect_id','desc')->paginate(3);
    	// var_dump($cateData);die;
    	return view('teacher.teacher_list',['teaData'=>$teaData]);
    }

    public function delete(Request $request)
    {
    	// echo 111;
    	$lect_id = $request->input('lect_id');
    	// var_dump($lect_id);die;
    	$res = Teacher::where('lect_id',$lect_id)->update([
    		'is_del' => 2
    	]);
    	
    	// var_dump($resluct);die;
    	if($res){
                return json_encode(['code'=>200,'msg'=>'删除成功!']); 
       	 	}else{
            	return json_encode(['code'=>201,'msg'=>'删除失败!']);
        	}
    }

    public function edit_index()
    {
    	$lect_id = request()->input('lect_id');
    	$teaData = Teacher::where('lect_id',$lect_id)->get()->toArray();
    	// print_r($teaData);die;
    	$cateData = Category::get()->toArray();
    	$cateData = $this->info($cateData);
    	// var_dump($cateData);die;
    	return view('teacher.teacher_edit',['cateData'=>$cateData,'teaData'=>$teaData]);
    }

    public function update_do(Request $request)
    {
    	$data = $request->input();
    	$image = $request->input('image');
        // var_dump($image);die;
        $n = strpos($image,',');
        $str = substr($image, $n+1);
        $str = base64_decode($str);
        // var_dump($str);die;
        $ext = $this->check_image_type($str);
        $ext = strtolower($ext);

        $imageName = md5(time().rand(1000,9999)).'.'.$ext;
        // print_r($imageName);die;
        $date = date("Y-n-j");
        if(!file_exists("./images/".$date)){ 
            mkdir("./images/".$date,0700);
        }
        $imageSrc = "./images/".$date."/". $imageName;
        $images = substr($imageSrc,1);
        $r = file_put_contents($imageSrc, $str);
		
        $teaData = Teacher::where('lect_id',$data['lect_id'])->first()->toArray();
        // print_r($teaData);die;
        $imageEdit = '.'.$teaData['image'];
        
    	$res = Teacher::where('lect_id',$data['lect_id'])->update([
    		'lect_name'=>$data['lect_name'],
    		'lect_resume'=>$data['lect_resume'],
    		'lect_style'=>$data['lect_style'],
    		'cate_id'=>$data['cate_id'],
    		'image'=>$images
    	]);

    	if($res){
            if(!empty($imageEdit)){
                unlink($imageEdit);
                return json_encode(['code'=>200,'msg'=>'修改成功!']);
            }else{
                return json_encode(['code'=>200,'msg'=>'修改成功!']);
            }
        }else{
            return json_encode(['code'=>201,'msg'=>'修改失败']);
        }
    }

  /**
     * 讲师收益展示
     * @return [type] [description]
     */
    public function profit_teacher_list(Request $request)
    {
        $user = 1;
        $lect_id = $request->input('lect_id');
        // dd($lect_id);
        // DB::enableQueryLog();
        $data = Profit::join('course','profit_teacher.course_id','=','course.course_id')
                    ->join('teacher','profit_teacher.lect_id','=','teacher.lect_id')
                    ->join('userdetail','profit_teacher.u_id','=','userdetail.u_id')
                    ->join('order','profit_teacher.order_id','=','order.order_id')
                    ->where('profit_teacher.lect_id',$lect_id)
                    ->orWhere('userdetail.u_id',1)
                    ->orWhere('order.u_id',1)
                    ->get()->toArray();
                    // print_r($data);die;
                    // $price = $data['course_price'];
        // dump(DB::getQueryLog());die;
        $price = [];
        $t_price = [];
        // $platform_price = [];
        foreach($data as $k=>$v){
            $price[] = $data[$k]['course_price'];


            foreach ($price as $key => $value) {
                $data[$k]['pp'] = $value*0.7;
                // $v[]['pp'] = $value*0.7;
                $t_price[] =  $data[$k]['pp'];
                // print_r($t_price);die;
                $total_price = array_sum($t_price);
            }
            // $platform_price = $price*0.7;


        }
        // 
        // print_r($total_price);die;
        return view('teacher.profit_teacher_list',['data'=>$data,'total_price'=>$total_price]);
    }
    public function teacher_examine(Request $request)
    {
        $u_head=$request->input('u_head');
        $u_name=$request->input('u_name');
        $u_id = $request->input('u_id');
        $teaData = Teacher::join('category','teacher.cate_id','=','category.cate_id')
                    ->join('userdetail','teacher.u_id','=','userdetail.u_id')
                    ->where('examine',0)
                    ->get()
                    ->toArray();
        // print_r($teaData);die;
        
        return view('teacher.teacher_examine',['teaData'=>$teaData,'u_head'=>$u_head,'u_name'=>$u_name,'u_id'=>$u_id]);
    }


    public function teacher_examine_do(Request $request)
    {
        $lect_id = $request->input('lect_id');
        $u_id = $request->input('u_id');
        $course_name = $request->input('u_name');
        // dd($course_name);
        $cate_name = $request->input('cate_name');
        // dd($cate_name);
        $u_name = $request->input('u_name');
        $u_head = $request->input('u_head');
        // var_dump($lect_id);die;
        // $res = Teacher::where('lect_id',$lect_id)->update([
        //     'examine' => 1,
        //     'is_del'=> 1
        // ]);
        $data = Category::where('cate_name',$cate_name)->get()->toArray();
        // dd($data);
        $cate_id = $data[0]['cate_id'];
        // dd($cate_id);
        $res = Teacher::insert([
            'u_id'=>$u_id,
            'cate_id'=>$cate_id,
            'lect_name'=>$u_name,
            'image'=>$u_head,
            'lect_resume'=>"这个人很牛逼",
            'lect_style'=>'很闷骚'
        ]);
        if($res){
                return json_encode(['code'=>200,'msg'=>'审核通过!']); 
            }else{
                return json_encode(['code'=>201,'msg'=>'审核通过失败!']);
            }
    }


    public function teacher_examine_del(Request $request)
    {
        $lect_id = $request->input('lect_id');
        $res = Teacher::where('lect_id',$lect_id)->delete();
        if($res){
                return json_encode(['code'=>200,'msg'=>'拒绝成功!']); 
            }else{
                return json_encode(['code'=>201,'msg'=>'好像出了一些问题,请重试!']);
            }
    }  
}
