<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    protected $table = "profit_teacher";
    protected $primaryKey = "pt_id";

    public $timestamps = false;
      
    protected $guarded = [];
}