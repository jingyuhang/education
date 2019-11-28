<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Storage;
class CourseController extends Controller
{
    //课程添加
    public function courseadd(Request $request)
    {
        // $validate=$request->validate([
        //     'course_name'=>'required',
        // ],['course_name.required'=>'分类名称必填']);
        $data=$request->input();
        // dd($data);
        // $path = "";
        // if($request->hasFile('title_picture')){
        //     $path = Storage::putFile('avatars', $request->file('title_picture'));
        //     dd($path);
        // }
        // dd($path);
        // $title_picture="http://www.edublog.com/".$path;
        // dd($title_picture);
        $file = $request->file('title_picture');
        // dd($file);
        if($request->hasFile('title_picture') && $file->isValid()){
            $path = $request->file('title_picture')->store('educationImages');
        }
        $res=DB::table('course')->insert([
            'course_name'=>$data['course_name'],
            'cate_id'=>$data['cate_id'],
            'create_time'=>time(),
            'intro'=>$data['intro'],
            'title_picture'=>$path,
            'course_price'=>$data['course_price']
        ]);
        // dd($res);
        if($res){
            return redirect()->action('course\courseController@courselist');
        }
    }
    //课程添加视图渲染
    public function course(Request $request)
    {
        $data=DB::table('category')->get()->toArray();
        return view('course.courseDefault.courseadd',['data'=>$data]);
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
    //课程列表
    public function courselist(Request $request)
    {
        $data=DB::table('category')->join('course','course.cate_id','=','category.cate_id')->get();
        // dd($data);
        return view('course.courseDefault.courselist',['data'=>$data]);
    }
    //课程删除
    public function coursedel(Request $request)
    {
        $course_id=$request->input();
        // dd($cate_id);
        $res = DB::table("course")->where('course_id',$course_id)->delete();
        if($res){
            return json_encode(['msg'=>"删除成功",'code'=>1]);
        }else{
            return json_encode(['msg'=>"删除失败",'code'=>2]);
        }
    }
    //课程修改
    public function courseedit(Request $request)
    {
        $course_id=$request->input();
        // dd($cate_id);
        $data=DB::table('course')->where('course_id',$course_id)->get()->toarray();
        // dd($data);
        return view('course.courseDefault.courseedit',['data'=>$data]);
    }
    //课程执行修改
    public function courseupdate(Request $request)
    {
        $data=$request->input();
        $file = $request->file('title_picture');
        // dd($file);
        if($request->hasFile('title_picture') && $file->isValid()){
            $path = $request->file('title_picture')->store('educationImages');
        }
        // dd($data);
        $where=[
            'course_id'=>$data['course_id'],
        ];
        // dd($path);
        $res=DB::table('course')->where($where)->update([
            'course_name'=>$data['course_name'],
            'create_time'=>time(),
            'intro'=>$data['intro'],
            'title_picture'=>$path,
            'course_price'=>$data['course_price']
        ]);
        // var_dump($data);die;
        // dd($data);
        if($res){
            return redirect()->action('course\courseController@courselist');
        }
    }

    //活动详情
    public function course_activity_show(Request $request)
    {
        $u_id=$request->input();
        // dd($u_id);
        $data=DB::table('course_activity')
        ->join('activity','course_activity.activity_id','=','activity.activity_id')
        ->where('course_id','=',$u_id)
        ->paginate(1);
        // dd($data);
        $res=DB::table('course_activity')
        ->join('course','course_activity.course_id','=','course.course_id')
        ->where('course_activity.course_id','=',$u_id)
        ->get()->toArray();
        // dd($res['course_price']);
        $price = '';
        foreach ($res as $key => $value) {
            $price  = $res[$key]->course_price;
        }
        $c_price = $price*0.5;
        // dd($c_price);
        return view('course\activity\course_activity',['data'=>$data,'res'=>$res,'c_price'=>$c_price]);
    }
    //添加活动
    public function create_course_activity(Request $request)
    {
        $aa=$request->input();
        // dd($aa);
        $activity_id=$aa['aa'];
        $course_id=$aa['course_id'];
        $a = implode(",", $activity_id);
        $res=DB::table('course_activity')->insert([
            'course_id'=>$course_id,
            'activity_id'=>$a,
        ]);
        // dd($res);
        if($res){
            return json_encode(['msg'=>"成功参加活动",'code'=>1]);
        }else{
            return json_encode(['msg'=>"参加活动失败",'code'=>2]);
        }
    }
}
