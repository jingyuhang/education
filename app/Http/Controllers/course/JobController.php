<?php
namespace App\Http\Controllers\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\Job;
use App\model\Part;
use DB;
class JobController extends Controller
{
    public function jobcreate()
    {
        $coursedata =DB::table('course')->get()->toArray();
        $data=DB::table('part')->get();
//        dd($data);
        return view('course.job.jobcreate',['data'=>$data,'coursedata'=>$coursedata]);
    }

    public function jobsave(Request $request)
    {
        //       echo  111;exit;
        $data = $request->all();
        $arr=[
            'course_id'=>$data['course_id'],
            'part_id'=>$data['part_id'],
            'job_name'=>$data['job_name'],
            'create_time'=>time(),
            'is_del'=>0,
        ];
        $res = Job::insert($arr);

//        dd($res);
        if ($res){
            echo "<script>alert('添加成功');location.href='/course/job';</script>";
        }else{
            echo "<script>alert('添加失败');location.href='/course/job/create';</script>";

        }
    }
    public function jobindex(Request $request)
    {
        $course_id = $request->input('course_id');
        $data=Job::
        join('course','job.course_id','=','course.course_id')
        ->join('part','job.part_id','=','part.part_id')
        ->where('job.course_id',$course_id)
        ->paginate(4);
//        dd($data);
        return view('course.job.jobindex',['data'=>$data]);
    }

    public function jobchange(Request $request)
    {
        $course_id=$request->course_id;
        $Catalog_data=Part::where("course_id",$course_id)->get()->toarray();
        if($Catalog_data){
            return json_encode(['code'=>200,'data'=>$Catalog_data]);
        }else{
            return json_encode(['code'=>201,'data'=>'']);
        }
    }

    public function jobdelete(Request $request)
    {
        $id=$request->input('id');
//        dd($id);
        $res=Job::where(['job_id'=>$id])->update(['is_del'=>1]);
//        dd($res);
        //判断
        if ($res){
            echo "<script>alert('删除成功');location.href='/course/job';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='/course/job'</script>";
        }
    }

    //修改
    public function jobupdate(Request $request)
    {
        $id=$request->input('id');
//        dd($id);
        $data=Job::join('course','job.course_id','=','course.course_id')->where(['job_id'=>$id])->first();
//        dd($data);
        $coursedata =DB::table('course')->get();
        $catelog =DB::table('part')->get();
//        dd($coursedata);
        return view('course.job.jobupdate',['data'=>$data,'course'=>$coursedata,'catalog'=>$catelog]);
    }

    public function jobdoupdate(Request $request)
    {
        //接id
        $data=$request->all();
//        dd($data);
        $res=Job::where('job_id',$data['job_id'])->update($data);
//        dd($res);
        //判断
        if($res){
            echo "<script>alert('修改成功');location.href='/course/job';</script>";
        }else{
            echo "<script>alert('修改失败');location.href='/course/job/update';</script>";
        }
    }
}
