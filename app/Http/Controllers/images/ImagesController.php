<?php

namespace App\Http\Controllers\images;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class ImagesController extends Controller
{
	public function images_add()
	{
		return view('images.images_add');
	}

    public function images_add_do(Request $request)
    {
    	$num = $request->input('num');
    	
    	// print_r($num);die;
    	$image = $request->input('images');
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
		

    	$res = DB::table('images')->insert([
    		'images'=>$images,
            'num'=>$num,
            'img_time'=>time()
    	]);
    	if($res) 
    			return json_encode(['code'=>200,'msg'=>'添加成功!']);
    		else 
    			return json_encode(['code'=>201,'msg'=>'添加失败!']);
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


    public function images_list(Request $request)
    {
    	$imgData = DB::table('images')->get()->toArray();
    	return view('images.images_list',['imgData'=>$imgData]);
    }

    public function images_del(Request $request)
    {
    	$img_id = $request->input('img_id');
    	
    	$res = DB::table('images')->where('img_id',$img_id)->delete();
    
    	if($res){
                return json_encode(['code'=>200,'msg'=>'删除成功!']); 
       	 	}else{
            	return json_encode(['code'=>201,'msg'=>'删除失败!']);
        	}
    }

    public function images_edit()
    {
    	return view('images.images_edit');
    }

    public function images_save(Request $request)
    {
    	$img_id = $request->input('img_id');
    	// var_dump($img_id);die;
    	$image = $request->input('images');
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
		
        $imgData = DB::table('images')->where('img_id',$img_id)->first();
        // print_r($imgData);die;
        $imageEdit = '.'.$imgData->images;
        
    	$res = DB::table('images')->where('img_id',$img_id)->update([
    		'images'=>$images
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
}
