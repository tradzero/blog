<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function Tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
