<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeExist()
    {
        $userId = Auth::id();
        return $this->where('is_deleted', 0)
        ->when($userId, function ($query) use ($userId) {
            return $query->where('visible', 0)
                ->orWhere('visible', 1)
                ->orWhere(['visible' => 2, 'user_id' => $userId]);
        });
    }
}
