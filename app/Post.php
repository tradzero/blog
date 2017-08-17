<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
{
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
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

        $filterDeleted = $this->where('is_deleted', 0);

        $filterVisible = $filterDeleted->where(function ($query) use ($userId) {
            return $query->orWhere('visible', 0)
                // 当用户id存在时 去查找特殊可见性文章
                ->when($userId, function ($query) use ($userId) {
                    return $query->orWhere('visible', 1)
                                 // 当visible = 2时 只有用户id为自身可以看到
                                 ->orWhere(function ($query) use ($userId) {
                                     $query->where('visible', 2)
                                           ->where('user_id', $userId);
                                 });
                });
        });
        
        return $filterVisible;
    }
}
