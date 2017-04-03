<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = $this->route('user');
        return [
            'edit' => 'required|integer|between:0,1',
            'username' => 'required|alpha_dash|min:4|max:40|unique:users,username,' . $id,
            'nickname' => 'required|min:1|max:20',
            'sex' => 'required|boolean',
            'password' => 'required_if:edit,0|min:6|alpha_dash|confirmed',
            'mail' => 'required|email|unique:users,mail,' . $id,
            'role' => 'required|between:0,2',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => '用户名必须填写',
            'nickname.required' => '昵称必须填写',
            'password.required_if' => '密码必须填写',
            'mail.required' => '邮箱必须填写',
            'username.alpha_dash' => '用户名只能由字母数字或下划线组成',
            'username.min' => '用户名最短长度为4',
            'username.max' => '用户名最长长度为40',
            'username.unique' => '用户名已被占用',
            'nickname.min' => '昵称最短长度为1',
            'nickname.max' => '昵称最长长度为20',
            'password.min' => '密码最短长度为6',
            'password.alpha_dash' => '密码只能由字母数字或下划线组成',
            'password.confirmed' => '两次密码不匹配',
            'mail.email' => '邮箱格式不正确',
            'mail.unique' => '邮箱已被占用',
        ];
    }
}
