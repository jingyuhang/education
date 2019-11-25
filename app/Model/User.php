<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table='userdetail';
    protected $primaryKey='u_id';
    public $timestamps=false;
    protected $guarded=[];
}
