<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeOccurance extends Model
{
    protected $fillable = ['time_at', 'themeID', 'userID', 'filmID', 'created_at', 'updated_at'];
}
