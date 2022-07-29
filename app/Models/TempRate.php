<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempRate extends Model
{
    protected $fillable = ['name', 'paramID', 'userID', 'filmID', 'created_at', 'updated_at'];
    protected $table = 'rating_params';
}
