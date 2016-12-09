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
        $type = (boolean)$request->type ? 'unlike' : 'like';

        $resultData['result'] = $this->guestLike($comment, $type, 'comment', $id);

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
        $comment->post_id = $post->id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = $content;
        $comment->save();
        $resultData['result'] = true;
        $resultData['comment'] = $comment;
        return response()->json($resultData);
    }
}
