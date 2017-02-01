<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::select('id', 'name')->get();
        return response()->json(compact('tags'));
    }
}
