<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeExist()
    {
        return $this->where('is_deleted', 0);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
