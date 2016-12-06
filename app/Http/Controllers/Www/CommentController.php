<?php

namespace App\Http\Controllers\Www;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Post;

use Auth;

class CommentController extends Controller
{
    public function like(Request $request, $id)
    {
        $resultData = collect(['result' => false]);
        $comment = Comment::exist()->findOrFail($id);
        $type = (boolean)$request->type;
        if(!Session('comment:' . $id)){
            if($type){
                // 点赞
                $comment->increment('unlike');
            }else{
                // 踩
                $comment->increment('like');
            }
            Session(['comment:' . $id => true]);
            $resultData['result'] = true;
        }

        $resultData['like'] = $comment->like;
        $resultData['unlike'] = $comment->unlike;
        return $resultData->toJson();
    }

    public function store(Request $request, $id)
    {
        $post = Post::exist()->findOrFail($id);
        $content = $request->content;
        $resultData = collect(['result' => false]);
        if(!$content || trim($content) == ''){
            return $resultData;
        }
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->comment = $content;
        $post->comments()->save($comment);
        $resultData['result'] = true;
        $resultData['comment'] = $comment;
        return response()->json($resultData);
    }
}
