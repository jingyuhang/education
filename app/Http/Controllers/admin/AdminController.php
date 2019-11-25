<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Role;
use DB;
class AdminController extends Controller
{
    //后台首页
    public function index()
    {
        return view('admin/index');
    }

    public function adminList()
    {
        $data = Admin::get();
        return view('adminRight/adminList',['data'=>$data]);
        // dd($data);die;
    }
    public function adminAdd(){
        return view('adminRight/adminAdd');
    }
    public function adminAddDo(Request $request)
    {
        $data = $request->input();
        if(empty($data['admin_name'])){
            echo "<script>alert('请输入用户名');window.history.back(-1);</script>";die;
        }
        if(empty($data['mobile'])){
            echo "<script>alert('请输入电话');window.history.back(-1);</script>";die;
        }
        if(empty($data['email'])){
            echo "<script>alert('请输入邮件');window.history.back(-1);</script>";die;
        }
        if(empty($data['password'])){
            echo "<script>alert('请输入密码');window.history.back(-1);</script>";die;
        }
        $result = DB::table('admin')->insert([
            'admin_name'=>$data['admin_name'],
            'mobile'=>$data['mobile'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'create_time'=>time()
        ]);
        unset($data['_token']);
        if($result){
            return json_encode(['code'=>200,'msg'=>"注册成功"]);
        }
    }
    public function roleList()
    {
        $data = Role::get();
        return view('adminRight/roleList',['data'=>$data]);
        // dd($data);die;
    }
    public function roleAdd()
    {
        return view('adminRight/roleAdd');
    }

    public function roleAddDo(Request $request)
    {
        $data = $request->input();
        if(empty($data['role_name'])){
            echo "<script>alert('请输入角色名');window.history.back(-1);</script>";die;
        }
        if(empty($data['description'])){
            echo "<script>alert('请输入角色描述');window.history.back(-1);</script>";die;
        }
        $result = DB::table('role')->insert([
            'role_name'=>$data['role_name'],
            'description'=>$data['description'],
            'create_time'=>time()
        ]);
        unset($data['_token']);
        if($result){
            return json_encode(['code'=>200,'msg'=>"添加成功"]);
        }
    }
}
