<?php

namespace App\Http\Controllers\course;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Question_answer;
use App\Model\Question_problem;
use App\Model\Question_type;
use Illuminate\Support\Facades\DB;
class LtemController extends Controller
{
    //列表展示
    public function index_add()
    {
            return view('course/item/index_add');
    }

    public function lt_radio()
    {
        return view('course/item/radio');
    }

    public function lt_warm()
    {
        return view('course/item/warm');
    }
    public function warm_add(Request $request)
    {
        $res=$request->all();
//                dd($res);
        $problem=$res['judge'];
        $type_id=$res['type_id'];
        $single_answer=$res['judge_answer'];
        $add_time=time();
        $single_a="1";
        $single_b="2";
        $p_name=Question_problem::insertGetId([
            'type_id'=>$type_id,
            'problem'=>$problem,
            'add_time'=>$add_time
        ]);
        if($p_name){
            $req=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_a,
                'is_answer'=>$single_answer,
                'add_time'=>$add_time
            ]);
            $req=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_b,
                'is_answer'=>$single_answer,
                'add_time'=>$add_time
            ]);
        }
        return redirect('/course/item/ltem_list');
    }

    public function lt_danger()
    {
        return view('course/item/danger');
    }
    public function danger_add(Request $request)
    {
        $res=$request->all();
        $type_id=$res['type_id'];
        $problem=$res['problem'];
        $single_a=$res['single_a'];
        $single_b=$res['single_b'];
        $single_c=$res['single_c'];
        $single_d=$res['single_d'];
        $single_answer=$res['single_answer'];
        $a = implode("|", $single_answer);
        $add_time=time();

//        dd($a);
        $p_name=Question_problem::insertGetId([
            'type_id'=>$type_id,
            'problem'=>$problem,
            'add_time'=>$add_time
        ]);
        if($p_name){
            $req=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_a,
                'is_answer'=>$a,
                'add_time'=>$add_time
            ]);
            $reqb=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_b,
                'is_answer'=>$a,
                'add_time'=>$add_time
            ]);
            $reqc=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_c,
                'is_answer'=>$a,
                'add_time'=>$add_time
            ]);
            $reqd=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_d,
                'is_answer'=>$a,
                'add_time'=>$add_time
            ]);
        }
        return redirect('/course/item/ltem_list');
    }
    public function bank_add(Request $request)
    {
      $res=$request->all();
//        dd($res);
        $problem=$res['problem'];
        $type_id=$res['type_id'];
        $single_a=$res['single_a'];
        $single_answer=$res['single_answer'];
        $single_c=$res['single_c'];
        $single_b=$res['single_b'];
        $single_d=$res['single_d'];
        $add_time=time();
        $p_name=Question_problem::insertGetId([
           'type_id'=>$type_id,
            'problem'=>$problem,
            'add_time'=>$add_time
        ]);

        if($p_name){
            $req=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_a,
                'is_answer'=>$single_answer,
                'add_time'=>$add_time
            ]);
            $reqb=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_b,
                'is_answer'=>$single_answer,
                'add_time'=>$add_time
            ]);
            $reqc=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_c,
                'is_answer'=>$single_answer,
                'add_time'=>$add_time
            ]);
            $reqd=Question_answer::insert([
                'question_id'=>$p_name,
                'answer'=>$single_d,
                'is_answer'=>$single_answer,
                'add_time'=>$add_time
            ]);
        }
//        dd(11);
        return redirect('/course/item/ltem_list');
    }

    public function ltem_list()
    {
        $data=Question_problem::get()->toarray();
//        dd();
//        dd($data);
//      $data=json_encode($data);
        return view('course/item/list',['data'=>$data]);
    }

    public function lt_del(Request $request)
    {
        $req=$request->all();
//        dd($req);
        $where=['id'=>$req['id']];
        $del=Question_problem::where($where)->delete();
        if($del){
            $del_as=$deleted = DB::delete('delete from question_answer where question_id='.$req['id'].'');
        }
        return redirect('course/item/ltem_list');
    }


    public function lt_upd(Request $request)
    {
        $req=$request->all();
//        dd($req);
        $where=['id'=>$req['id']];
        $data=Question_problem::
            leftJoin('question_answer','question_answer.question_id','=','question_problem.id')
            ->where('question_problem.id',$req['id'])->get()->toarray();
//        dd($data);
        $dad=$data[0]['is_answer'];
        $is_yes=strtr($dad,'|',",");
//dd($is_yes);

//      $data=json_encode($data);
        $type_id=$data[0]['type_id'];
//        dd($type_id);
        if($type_id==1){
            return view('course/item/list_upd',['data'=>$data]);

        }else if($type_id==2){
            return view('course/item/list_upd_danger',['data'=>$data,'is_yes'=>$is_yes]);
        }else if($type_id==3){
            return view('course/item/list_upd_warm',['data'=>$data]);
        }
//        dd();
    }


}
