<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CollectModel extends Model
{
    protected $table = 'collect';
    protected $primaryKey='collect_id';
    public $timestamps = false;
      
    protected $guarded = [];
}
