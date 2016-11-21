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
        $post = Post::findOrFail($id);
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
