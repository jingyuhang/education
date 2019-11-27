<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $primaryKey ='test_id';
	protected $table = 'test';
	public $timestamps = false;
	protected $guarded = [];
}