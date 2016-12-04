<?php

namespace App\Http\Controllers\Www;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $indexPosts = Post::exist()->orderBy('created_at', 'desc')->paginate(5);
        return view('welcome', compact('indexPosts'));
    }
    
    public function like(Request $request, $id)
    {
        $resultData = Collect(['result' => false]);
        $post = Post::exist()->findOrFail($id);
        $type = (boolean)$request->type;
        
        if(!Session('post:' . $id)){
            if($type){
                // 点赞
                $post->increment('like');
            }else{
                // 踩
                $post->increment('unlike');
            }
            Session(['post:' . $id => true]);
            $resultData['result'] = true;
        }

        $resultData['like'] = $post->like;
        $resultData['unlike'] = $post->unlike;
        return $resultData->toJson();
    }

    public function show($id)
    {
        $post = Post::exist()->with('tags', 'user', 'comments.user')->findOrFail($id);
        return view('post', compact('post'));
    }
    
}
