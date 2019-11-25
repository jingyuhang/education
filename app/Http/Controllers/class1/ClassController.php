<?php

namespace App\Http\Controllers\class1;

use App\Model\Class1;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    //添加分类页面
    public function class_cate_add()
    {
        $p_category=Class1::where('pid',0)->get()->toArray();
      //  dd($p_category);
        return view('/class/class_cate_add',compact('p_category'));
    }
    //添加分类执行
    public function class_cate_add_do()
    {

        $data=request()->all();
        dd($data);
        $cate_name=$data['cate_name'];
        $pid=$data['pid'];
        $add_time=time();
        $data=[
            'cate_name'=>$cate_name,
            'pid'=>$pid,
            'is_del'=>1,
            'add_time'=>$add_time,
        ];
        $cate_response=Class1::insert($data);

    }
}
