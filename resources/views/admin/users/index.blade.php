@extends('admin.master')
@section('title')用户管理@endsection
@section('subtitle')所有用户@endsection

@section('content')
    <div>
        @if(session('success'))
            @include('admin.component.alert-success', ['success' => session('success')])
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <span class="box-title">用户列表</span>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>用户名</th>
                                <th>昵称</th>
                                <th>角色</th>
                                <th>当前状态</th>
                                <th>创建时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->nickname }}</td>
                                    <td>{{ trans('user.role:' . $user->role) }}</td>
                                    <td>{{ trans('user.status:' . $user->is_banned) }}</td>
                                    <td>{{ $user->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">查看</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection