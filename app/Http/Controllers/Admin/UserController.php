<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $userData = $request->all();
        $user = User::create($userData);
        $user->role = $request->get('role', 2);
        $user->save();
        if ($user) {
            return redirect()->route('users.index')->with('success', '创建成功');
        }
    }

    public function show($id)
    {
        $user = $this->getUsersLatestInfoById($id);
        return view('admin.users.profile', compact('user'));
    }

    private function getUsersLatestInfoById($id)
    {
        $user = User::with([
            'posts' => function ($query) {
                $query->orderBy('updated_at', 'desc')->take(5);
            },
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc')->take(5);
            },
            'comments.post'
        ])->withCount('comments', 'posts')->findOrFail($id);
        return $user;
    }
}
