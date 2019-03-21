<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Short extends Model
{
    protected $fillable = ['url', 'hits'];
}
