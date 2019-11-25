<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Storage;
class PartController extends Controller
{
    //章节添加
    public function partadd(Request $request)
    {
        // $validate=$request->validate([
        //     'course_name'=>'required',
        // ],['course_name.required'=>'分类名称必填']);
        $data=$request->input();
        // dd($data);
        $res=DB::table('part')->insert([
            'part_name'=>$data['part_name'],
            'course_id'=>$data['course_id'],
            'part_head'=>$data['part_head'],
            'part_describe'=>$data['part_describe'],
            'is_free'=>$data['is_free']
        ]);
        // dd($res);
        if($res){
            return json_encode(['code'=>1,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'添加失败']);
        }
    }
    //章节添加视图渲染
    public function part(Request $request)
    {
        $data=DB::table('course')->get()->toArray();
        return view('course.part.partadd',['data'=>$data]);
    }
    //无限极分类
    public function Info($data,$cate_id=0)
    {
        static $arr=[];
        foreach($data as $v){
            if($v['cate_id']==$cate_id){
                $arr[]=$v;
                $this->info($data,$v['cate_id']);
            }
        }
        return $arr;
    }
    //章节列表
    public function partlist(Request $request)
    {
        $course_id = $request->input('course_id');
        // dd($course_id);
        $data=DB::table('part')->join('course','course.course_id','=','part.course_id')->where('part.course_id',$course_id)->get();
        // dd($data);
        return view('course.part.partlist',['data'=>$data]);
    }
    //章节删除
    public function partdel(Request $request)
    {
        $part_id=$request->input();
        // dd($cate_id);
        $res = DB::table("part")->where('part_id',$part_id)->delete();
        if($res){
            return json_encode(['msg'=>"删除成功",'code'=>1]);
        }else{
            return json_encode(['msg'=>"删除失败",'code'=>2]);
        }
    }
    //章节修改
    public function partedit(Request $request)
    {
        $part_id=$request->input();
        // dd($cate_id);
        $data=DB::table('part')->where('part_id',$part_id)->get()->toarray();
        // dd($data);
        return view('course.part.partedit',['data'=>$data]);
    }
    //章节执行修改
    public function partupdate(Request $request)
    {
        $data=$request->input();
        // dd($data);
        $where=[
            'part_id'=>$data['part_id'],
        ];
        // dd($where);
        $res=DB::table('part')->where($where)->update([
            'part_name'=>$data['part_name'],
            'part_head'=>$data['part_head'],
            'part_describe'=>$data['part_describe'],
            'is_free'=>$data['is_free']
        ]);
        // var_dump($data);die;
        // dd($data);
        if($res){
            return json_encode(['msg'=>"修改成功",'code'=>1]);
        }else{
            return json_encode(['msg'=>"修改失败",'code'=>2]);
        }
    }
     //上传视频
    public function audio(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file'); // 获取上传的文件
        // 获取文件相关信息
            $originalName = $file->getClientOriginalName(); // 文件原名
            $extension = $file->extension();     // 例如，png
            $new_file_name = uniqid('notefeel_') . '.' . $extension;
            $realPath = $file->getRealPath(); //临时文件的绝对路径
            Storage::disk('audio')->put($new_file_name, file_get_contents($realPath)); // 文件名称 ， 内
            return response(['message' => '上传成功','url'=> '/uploads/audio/'.$new_file_name], 201);
        }else{
            return response(['message' => '请重新上传'], 400);
        }
    }
}
