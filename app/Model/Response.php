<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $primaryKey ='r_id';
	protected $table = 'response';
	public $timestamps = false;
	protected $guarded = [];
}
