<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $table='part';
    protected $primaryKey='part_id';
    public $timestamps=false;
    protected $guarded=[];
}
