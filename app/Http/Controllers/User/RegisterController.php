<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class RegisterController extends Controller
{
    //邮箱验证
    public function seluser(Request $request)
	{
        $u_email=$request->input('u_email');
        // dd($u_email);
        $data=DB::table('user')->where(['u_email'=>$u_email])->first();
        if($data){
            return json_encode(['code'=>1,'msg'=>'该邮箱已被注册']);
        }else{
            return json_encode(['code'=>2,'msg'=>'可以使用']);
        }
	}
    //注册视图
    public function register_do()
    {
        return view('register/register');
    }

	public function register(Request $request)
	{
        $validate=$request->validate([
            'u_email'=>'required|email',
            'u_pwd'=>'required',
        ],['u_email.required'=>'邮箱必填','u_email.email'=>'邮箱格式不正确','u_pwd.required'=>'密码必填']);
        $u_email=$request->input('u_email');
		// dd($u_email);
        $u_pwd=$request->input('u_pwd');
        // dd($u_pwd);
        // $validatedData = $request->validate([
        //     'u_email' => 'required|email',
        //     'u_pwd' => 'required',
        // ]);
        $res =DB::table('user')->insert([
            'u_email'=>$u_email,
            'u_pwd'=>$u_pwd
        ]);
        // dd($res);
        if($res){
            return json_encode(['code'=>1,'msg'=>'注册成功']);
        }else{
            return json_encode(['code'=>2,'msg'=>'注册失败']);
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
        }
	}
}
