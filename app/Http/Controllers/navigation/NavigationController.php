<?php

namespace App\Http\Controllers\navigation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class NavigationController extends Controller
{
    public function naviga_add()
    {
    	return view('naviga.naviga_add');
    }

    public function naviga_add_do(Request $request)
    {
    	$data = $request->input();
    	$res = DB::table('navigation')->insert([
    		'navigation_name'=>$data['navigation_name'],
    		'navigation_url'=>$data['navigation_url']
    	]);
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'添加成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'添加失败']);
    	}
    }

    public function naviga_list()
    {
    	$data = DB::table('navigation')->get()->toArray();
    	return view('naviga.naviga_list',['data'=>$data]);
    }

    public function naviga_del(Request $request)
    {
    	$navigation_id = $request->input('navigation_id');
    	$res = DB::table('navigation')->where('navigation_id',$navigation_id)->delete();
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'删除成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'删除失败']);
    	}
    }

    public function naviga_edit(Request $request)
    {
    	$navigation_id = $request->input('navigation_id');
    	// print_r($navigation_id);die;
    	$data = DB::table('navigation')->where('navigation_id',$navigation_id)->get()->toArray();
    	// print_r($data);die;
    	return view('naviga.naviga_edit',['data'=>$data]);
    }

    public function naviga_edit_do(Request $request)
    {
    	$navigation_id = $request->input('navigation_id');
    	$navigation_name = $request->input('navigation_name');
    	$navigation_url = $request->input('navigation_url');
    	$res = DB::table('navigation')->where('navigation_id',$navigation_id)->update([
    		'navigation_name'=>$navigation_name,
    		'navigation_url'=>$navigation_url
    	]);
    	if($res){
    		return json_encode(['code'=>200,'msg'=>'修改成功']);
    	}else{
    		return json_encode(['code'=>201,'msg'=>'修改失败']);
    	}
    }
}
