<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:100',
            'content' => 'required',
            'visible' => 'required|between:0, 2',
            'tag' => 'array',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => '标题必须填写',
            'title.max' => '标题最大长度为:max',
            'content.required' => '内容必须填写',
            'visible.required' => '必须设置可见性',
            'visible.between' => '可见性错误'
        ];
    }
}
