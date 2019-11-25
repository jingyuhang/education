<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InformationModel extends Model
{
    protected $table = 'informations';
    protected $primaryKey='informations_id';
    public $timestamps = false;
      
    protected $guarded = [];
}
