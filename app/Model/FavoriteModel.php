<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FavoriteModel extends Model
{
    protected $table = 'favorite';
    protected $primaryKey='favorite_id';
    public $timestamps = false;
      
    protected $guarded = [];
}
