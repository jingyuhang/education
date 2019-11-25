<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $primaryKey ='lect_id';
	protected $table = 'teacher';
	public $timestamps = false;
	protected $guarded = [];
}
