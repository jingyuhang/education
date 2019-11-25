<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $primaryKey ='q_id';
	protected $table = 'questions';
	public $timestamps = false;
	protected $guarded = [];
}
