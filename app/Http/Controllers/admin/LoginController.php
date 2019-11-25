<?php

/*
 * This file is part of the gedongdong/laravel_rbac_permission.
 *
 * (c) gedongdong <gedongdong2010@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Model\Users;
use App\Library\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        if (session('user')) {
            return redirect(route('admin.index.white'));
        }

        return view('login.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => '请输入登录名',
            'email.email'       => '邮箱格式有误',
            'password.required' => '请输入密码',

        ]);

        if ($validator->fails()) {
            return Response::response(['code' => Response::PARAM_ERROR, 'msg' => $validator->errors()->first()]);
        }

        $data = $validator->getData();

        $user = Users::where('email', '=', $data['email'])->first();
        if (!$user || !Hash::check($data['password'], $user->password)) {
            return Response::response(['code' => Response::BAD_REQUEST, 'msg' => '登录名或密码有误']);
        }

        if (Users::STATUS_DISABLE == $user->status) {
            return Response::response(['code' => Response::BAD_REQUEST, 'msg' => '您的账户被禁用，请联系管理员']);
        }

        session(['user' => $user]);

        return Response::response();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user');

        return redirect(route('admin.login.white'));
    }
    public function person(Request $request)
    {
        $user = $request->session()->get('user');
        $u_id = $user['id'];
        $data = Users::where('id',$u_id)->select('id', 'email', 'name', 'administrator', 'status', 'created_at')->paginate(config('page_size'));;
        return view('login.index',['data'=>$data]);
    }
}
