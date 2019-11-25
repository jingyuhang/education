<?php

/*
 * This file is part of the gedongdong/laravel_rbac_permission.
 *
 * (c) gedongdong <gedongdong2010@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
class UsersRoles extends Model
{
    protected $table = 'users_roles';

    protected $guarded = [];
}
