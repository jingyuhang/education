<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;
use DB;
class CategoryController extends Controller
{
    //课程分类添加
    public function add(Request $request)
    {
        $validate=$request->validate([
            'cate_name'=>'required',
        ],['cate_name.required'=>'分类名称必填']);
        $data=$request->input();
        // dd($data);die;
        $res=DB::table('category')->insert([
            'cate_name'=>$data['cate_name'],
            'pid'=>$data['cate_id']
        ]);
        // dd($res);
        if($res){
            return json_encode(['code'=>1,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'添加失败']);
        }
    }
    //渲染添加视图
    public function category(Request $request)
    {
        $data=Category::get()->toArray();
        // dd($data);die;
        $data=$this->Info($data);
        // dd($data);die;
        return view('course.cate.addcate',['data'=>$data]);
    }
    //无限极分类
    public function Info($data,$pid=0,$level=1)
    {
        static $arr=[];
        foreach($data as $v){
            if($v['pid']==$pid){
                $v['level']=$level;
                $arr[]=$v;
                $this->info($data,$v['cate_id'],$level+1);
            }
        }
        return $arr;
    }
    //分类列表
    public function catelist(Request $request)
    {
        $data=Category::get()->toArray();
        $data = $this->info($data);
        // dd($data);die;
        return view('course.cate.catelist',['data'=>$data]);
    }
    //分类删除
    public function catedel(Request $request)
    {
        $cate_id=$request->input();
        // dd($cate_id);
        $where=[
            'pid'=>$cate_id,
        ];
        $data=DB::table('category')->where($where)->get()->toArray();
        // dd($data);die;
        if(!empty($data)){
            return json_encode(['msg'=>"该分类下有子分类,请先删除子分类",'code'=>2]);
        }
        $res = DB::table("category")->where('cate_id',$cate_id)->delete();
        if($res){
            return json_encode(['msg'=>"删除成功",'code'=>1]);
        }else{
            return json_encode(['msg'=>"删除失败",'code'=>2]);
        }
    }
    //分类修改
    public function cateedit(Request $request)
    {
        $cate_id=$request->input();
        // dd($cate_id);
        $data=DB::table('category')->where('cate_id',$cate_id)->get()->toarray();
        // dd($data);
        return view('course.cate.cateedit',['data'=>$data]);
    }
    //执行修改
    public function cateupdate(Request $request)
    {
        $data=$request->input();
        // dd($data);
        $where=[
            'cate_id'=>$data['cate_id'],
        ];
        // dd($where);
        $res=DB::table('category')->where($where)->update([
            'cate_name'=>$data['cate_name'],
        ]);
        // var_dump($data);die;
        // dd($data);
        if($res){
            return json_encode(['msg'=>"修改成功",'code'=>1]);
        }else{
            return json_encode(['msg'=>"修改失败",'code'=>2]);
        }
    }
}
