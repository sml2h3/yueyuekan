<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'admin_user';
    protected $primaryKey = "Id";
    public $timestamps = false;
}
