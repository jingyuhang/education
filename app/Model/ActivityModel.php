<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ActivityModel extends Model
{
    protected $table = 'activity';
    protected $primaryKey='activity_id';
    public $timestamps = false;
      
    protected $guarded = [];
}
