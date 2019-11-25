<?php

namespace App\Http\Controllers\course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Note;
use App\Model\Course;
class NoteController extends Controller
{
    public function create()
    {
        return view('course.note.create');
    }
    public function store(Request $request)
    {
        $user = $request->session()->get('user');
        $u_id = $user['id'];
        $course_id = $request->input('course_id');
        $note_desc = $request->input('note_desc');
        $create_time = time();
        $data = Note::insert([
            'u_id' => $u_id,
            'course_id' => $course_id,
            'note_desc' => $note_desc,
            'create_time' => $create_time
        ]);
        return redirect()->action('course\NoteController@index');
    }
    public function index(Request $request)
    {
        $course_id = $request->input('course_id');
        // dd($course_id);
        $data = Note::join('course','note.course_id','=','course.course_id')->where('note.course_id',$course_id)->orWhere('note.is_del',1)->get();
        return view('course.note.index',['data'=>$data]);
    }

    public function del(Request $request)
    {
        $note_id = $request->input('id');
        $res = Note::where('note_id',$note_id)->update(['is_del'=>2]);
        if($res){
            return redirect()->action('course\NoteController@index');
        }
    }
}