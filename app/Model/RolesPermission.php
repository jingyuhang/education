<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class RolesPermission extends Model
{
    protected $table = "roles_permission";
    protected $primaryKey = "id";

    public $timestamps = false;
      
    protected $guarded = [];
}