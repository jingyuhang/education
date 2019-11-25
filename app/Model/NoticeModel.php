<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NoticeModel extends Model
{
    protected $table = 'notice';
    protected $primaryKey='notice_id';
    public $timestamps = false;
      
    protected $guarded = [];
}
