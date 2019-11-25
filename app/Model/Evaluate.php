<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evaluate extends Model
{
    protected $primaryKey ='evaluate_id';
	protected $table = 'evaluate';
	public $timestamps = false;
	protected $guarded = [];
}
