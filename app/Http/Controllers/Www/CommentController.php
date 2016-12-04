<?php

namespace App\Http\Controllers\Www;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

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
}
