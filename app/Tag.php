<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function Posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
