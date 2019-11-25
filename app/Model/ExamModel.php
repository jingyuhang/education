<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExamModel extends Model
{
    protected $table = 'exam';
    protected $primaryKey='exam_id';
    public $timestamps = false;
      
    protected $guarded = [];
}
