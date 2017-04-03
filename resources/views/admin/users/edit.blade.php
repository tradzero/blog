@extends('admin.master')
@section('title')用户管理@endsection
@section('subtitle')修改用户@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            @if(count($errors))
                @include('admin.component.alert-danger', [ 'errors' => $errors ])
            @endif
            <div class="box">
                <div class="box-header">
                    <span class="box-title">修改用户</span>
                </div>
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    <div class="box-body"> 
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input type="hidden" name="edit" value="1">
                        <div class="form-group">
                            <label for="input_user_name">用户名</label>
                            <input type="text" id="input_user_name" placeholder="请输入用户名" readonly 
                                name="username" class="form-control" value="{{ $user->username }}">
                        </div>
                        <div class="form-group">
                            <label for="input_nick_name">昵称</label>
                            <input type="text" id="input_nick_name" placeholder="请输入昵称" 
                                name="nickname" class="form-control" value="{{ old('nickname') ? : $user->nickname }}">
                        </div>
                        <div class="form-group">
                            <label for="select_sex">性别</label>
                            <select name="sex" id="select_sex" class="form-control">
                                <option value="0" @if($user->sex == 0) selected @endif>男</option>
                                <option value="1" @if($user->sex == 1) selected @endif>女</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="input_password">密码</label>
                            <input type="text" id="input_password" placeholder="请输入密码" name="password" 
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="input_password_confirm">重复密码</label>
                            <input type="text" id="input_password_confirm" placeholder="请输入重复密码" 
                                name="password_confirmation" class="form-control">
                        </div>
                        <button class="btn btn-primary" type="button" onclick="randomPassword()">随机生成</button>
                        <div class="form-group">
                            <label for="input_mail">邮箱</label>
                            <input type="text" id="input_mail" name="mail" placeholder="请输入邮箱" 
                                class="form-control" value="{{ old('mail') ? : $user->mail }}">
                        </div>
                        <div class="form-group">
                            <label for="select_role">设置角色</label>
                            <select name="role" id="select_role" class="form-control">
                                <option value="1" @if($user->role == 0) selected @endif>授权用户</option>
                                <option value="2" @if($user->role == 1) selected @endif>游客</option>
                            </select>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function randomPassword(){
            var password = rand();
            $("#input_password").val(password);
            $("#input_password_confirm").val(password);
        }
        function rand(){
            var text="";

            var possible="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for (var i = 0; i < 15; i++) text += possible.charAt(Math.floor(Math.random()*possible.length));

            return text;
        }
    </script>
@endsection