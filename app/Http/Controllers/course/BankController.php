<?php

namespace App\Http\Controllers\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Storage;
class BankController extends Controller
{
    //题目添加
    public function bankadd(Request $request)
    {   
        $data=$request->all();
        dd($data);
    }
}
