<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Paymethod extends Model
{
    protected $table='pay_method';
    protected $primaryKey='method_id';
    public $timestamps=false;
    protected $guarded=[];
}