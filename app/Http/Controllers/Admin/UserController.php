<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Auth;
use App\Mail\RegisterByInvite;
use Mail;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('index', User::class);

        $users = User::paginate();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('admin.users.create');
    }

    public function store(UserRequest $request)
    {
        $this->authorize('store', User::class);
    
        $userData = $request->all();
        $user = User::create($userData);
        $user->role = $request->get('role', 2);
        $user->save();
        if (config('blog.mail.enable')) {
            Mail::to($user->mail)->send(
                new RegisterByInvite($user->username, $user->nickname, $request->get('password'))
            );
        }
        return redirect()->route('users.index')->with('success', '创建成功');
    }

    public function show($id)
    {
        $user = $this->getUsersLatestInfoById($id);

        $this->authorize('show', $user);

        return view('admin.users.profile', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('edit', $user);

        return view('admin.users.edit', compact('user'));
    }
    
    public function update($id, UserRequest $request)
    {
        $user = User::findOrFail($id);
        
        $this->authorize('update', $user);
        
        $userData = $request->only(['nickname', 'sex', 'password', 'mail', 'role']);
        $userData = array_filter($userData, function ($value) {
            return !is_null($value);
        });
        $user->update($userData);
        return redirect()->route('users.index')->with('success', '修改成功');
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
