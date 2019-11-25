<?php

namespace App\Http\Controllers\information;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\InformationModel;

class InformationController extends Controller
{


    public function informationadd(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $information_title=$data['information_title'];
        $information_content=$data['information_content'];
        $information_num=$data['information_num'];
////        dd($information_content);
//        $information_add=InformationModel::create([
//            'information_title'=>$information_title,
//            'information_content'=>$information_content,
//            'information_num'=>$information_num,
//            'information_time'=>time(),
//        ]);

        //判断是否上传文件
        if($request->file('information_photo')!=''){
            $date=date('Y-n-j',time());
//        dd($date);
//            $path=storage_path("app\public");
            $information_photo_path = $request->file('information_photo')->store('image\\'.$date.'\\');

//            dd($information_photo_path);
//            $path_new=$path.'\\'.$information_photo_path;
//            dd($path_new);
//            D:\wnmp\www\education\storage\app\public\image\2019-11-22\51BO8snCAMu0adoI3cpNMOkgNVJPocjGiw9ByVgf.jpeg
            //有图片添加
            $information_add=InformationModel::create([
            'information_title'=>$information_title,
            'information_content'=>$information_content,
            'information_num'=>$information_num,
            'information_time'=>time(),
            'information_photo'=>$information_photo_path,
        ]);//返回的是一个包含商品ID的对象
        }else{
//            dd(1);
            //不加图片添加
            $information_add=InformationModel::create([
            'information_title'=>$information_title,
            'information_content'=>$information_content,
            'information_num'=>$information_num,
            'information_time'=>time(),
        ]);//返回的是一个包含商品ID的对象
        }

        
        if($information_add){
            echo json_encode(['code'=>1,'msg'=>'资讯添加成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'资讯添加失败'],JSON_UNESCAPED_UNICODE);
        }

    }


    public function informationshow(Request $request)
    {
//        $sex_arr=[1=>'未删除',2=>'已删除'];
//        $information_info=InformationModel::get()->toarray();
//        echo "<pre>";
//        foreach ($information_info as $k=> $v)
//        {
//            $information_info[$k]['is_del']=$sex_arr[$v['is_del']];
//        }
//
//        return view("/information/show",['information_info'=>$information_info]);
        $information_title=$request->get('information_title');
        $information_content=$request->get('information_content');
//            dd($information_content);
        $sex_arr=[1=>'未删除',2=>'已删除'];

        $where=[];
        //咨询标题不为空
        if(!empty($information_title) && empty($information_content)){
            $where[]=['information_title','like',"%".$information_title."%"];
            //资讯内容不为空
        }elseif (!empty($information_content) && empty($information_title))
        {
            $where[]=['information_content','like',"%".$information_content."%"];
            //都为空
        }elseif(empty($information_content) && empty($information_title)){
            $where=[];
            //都不为空
        }else{
            // $where[]=['is_del','=',1];
            $where[]=['information_content','like',"%".$information_content."%"];
            $where[]=['information_title','like',"%".$information_title."%"];
        }
//            dd($where);
        $information_info=InformationModel::where($where)->orWhere('is_del',1)->orderBy('information_id','desc')->paginate(2);
//        dd($information_info);
      
        foreach ($information_info as $k=> $v)
        {
            $information_info[$k]['is_del']=$sex_arr[$v['is_del']];
        }


//        print_r($information_info);die;
        return view("/information/show",['information_info'=>$information_info,'information_content'=>$information_content,'information_title'=>$information_title]);
    }

    public function informationupdate_view(Request $request)
    {
        $information_id=$request->information_id;
       $information_info=InformationModel::where('information_id',$information_id)->get()->toarray();
//        dd($information_info);
        return view('information/update',['information_info'=>$information_info[0]]);
    }

    public function informationupdate(Request $request)
    {
        $data=$request->all();
//        dd($data);
        $information_title=$data['information_title'];
        $information_content=$data['information_content'];
        $information_num=$data['information_num'];
        $information_id=$data['information_id'];
////        dd($information_content);
//        $information_add=InformationModel::create([
//            'information_title'=>$information_title,
//            'information_content'=>$information_content,
//            'information_num'=>$information_num,
//            'information_time'=>time(),
//        ]);

        //判断是否上传文件
        if($request->file('information_photo')!=''){
            $date=date('Y-n-j',time());
//        dd($date);
//            $path=storage_path("app\public");
            $information_photo_path = $request->file('information_photo')->store('image\\'.$date.'\\');

//            dd($information_photo_path);
//            $path_new=$path.'\\'.$information_photo_path;
//            dd($path_new);
//            D:\wnmp\www\education\storage\app\public\image\2019-11-22\51BO8snCAMu0adoI3cpNMOkgNVJPocjGiw9ByVgf.jpeg
            //有图片修改
            $update_info=[
                'information_title'=>$information_title,
                'information_content'=>$information_content,
                'information_num'=>$information_num,
                'information_time'=>time(),
                'information_photo'=>$information_photo_path,
            ];
            $information_add=InformationModel::where('information_id',$information_id)->update($update_info);//返回的是一个包含商品ID的对象
        }else{
//            dd(1);
            //不加图片添加
            $information_add=InformationModel::where('information_id',$information_id)->update([
                'information_title'=>$information_title,
                'information_content'=>$information_content,
                'information_num'=>$information_num,
                'information_time'=>time(),
            ]);//返回的是一个包含商品ID的对象
        }


        if($information_add){
            echo json_encode(['code'=>1,'msg'=>'资讯修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(['code'=>0,'msg'=>'资讯修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }

    public function informationdel(Request $request)
    {
        $information_id=$request->information_id;
//        dd($information_id);
        $del_result=InformationModel::where('information_id',$information_id)->update([
            'is_del'=>2
        ]);
        $url=url('InformationController/informationshow');
        if($del_result){

            echo "<script>alert('咨询删除成功');window.location.href='$url';</script>";
        }else{
            echo "<script>alert('咨询删除成功');window.location.href='$url';</script>";
        }
    }
}
