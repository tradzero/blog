<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::withCount('posts')->paginate();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with('success', '新标题创建成功');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->name = $request->name;
        $tag->save();
        return redirect()->route('tags.index')->with('success', '修改成功');
    }
}