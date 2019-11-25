<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\model\User;
class UserController extends Controller
{
    //邮箱验证
    public function seluser(Request $request)
	{
        $u_email=$request->input('u_email');
        // dd($u_email);
        $data=DB::table('userdetail')->where(['u_email'=>$u_email])->first();
        if($data){
            return json_encode(['code'=>1,'msg'=>'该邮箱已被注册']);
        }else{
            return json_encode(['code'=>2,'msg'=>'可以使用']);
        }
    }
    //登录视图
    public function login_do()
    {
        return view('register/login');
    }
    //登录
	public function login(Request $request)
	{
		$u_email=$request->input('u_email');
		// dd($name);
        $u_pwd=$request->input('u_pwd');
        $data=DB::table('user')->where(['u_email'=>$u_email,'u_pwd'=>$u_pwd])->first();
        // dd($data);
        if($data){
            return json_encode(['code'=>1,'msg'=>'登陆成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'邮箱或密码输入错误']);
        }
    }
    //用户视图
    public function useradd(Request $request)
    {
        return view('register.useradd');
    }
    //用户添加
    public function userdoadd(Request $request)
    {
        $validate=$request->validate([
            'u_email'=>'required|email',
            'u_pwd'=>'required',
        ],['u_email.required'=>'邮箱必填','u_email.email'=>'邮箱格式不正确','u_pwd.required'=>'密码必填']);
        $data=$request->input();
        // dd($data);
        $file = $request->file('u_head');
        // dd($file);
        if($request->hasFile('u_head') && $file->isValid()){
            $path = $request->file('u_head')->store('educationImages');
        }
        $res=DB::table('userdetail')->insert([
            'u_name'=>$data['u_name'],
            'u_age'=>$data['u_age'],
            'u_sex'=>$data['u_sex'],
            'u_email'=>$data['u_email'],
            'u_pwd'=>md5($data['u_pwd']),
            'u_time'=>time(),
            'u_head'=>$path,
        ]);
        // dd($res);
        if ($res){
            echo "<script>alert('添加成功');location.href='/user/userlist';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/user/userlist';</script>";

        }
    }
    //用户详情
    public function userlist(Request $request)
    {
        $data=DB::table('userdetail')->get();
        // dd($data);
        return view('register.userlist',['data'=>$data]);
    }
    //用户收藏
    public function usercollect(Request $request)
    {
        $u_id=$request->input();
        // dd($data);
        $data=DB::table('collect')->join('favorite','collect.favorite_id','=','favorite.favorite_id')
        ->join('course','collect.course_id','=','course.course_id')
        ->where('collect.u_id',$u_id)
        ->get();
        return view('register.usercollect',['data'=>$data]);
    }
    //禁用启用
    public function useron(Request $request)
    {
        $post = request()->all();
        //dd($post);
        if (empty($post['u_id'])) {
            return json_encode(['code'=>1,'msg'=>'参数id不能为空!']);
        }else{
            $data =User::where(['u_id'=>$post['u_id']])->update(['ustatus'=>$post['ustatus']]);
        }
    }
    //用户下面的订单
    public function userorder(Request $request)
    {
        $u_id=$request->input('u_id');
//        dd($id);
        $order=DB::table('order')->join('detail','order.order_id','=','detail.order_id')
            ->join('course','order.course_id','=','course.course_id')
            ->join('pay_method','order.pay_id','=','pay_method.pay_id')
            ->where('order.u_id',$u_id)
            ->get();
    //    dd($order);
        return view('register.userOrder',['order'=>$order]);
    }
}
