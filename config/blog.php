<?php

return [
    /**
     * 博客站点名
     */
    'name' => env('APP_NAME'),

    /**
     * 博客次标题
     */
    'second_title' => 'recoding, learning',

    /**
     * 博客header部分链接部分 建议不要超过5个
     */
    'urls' => [
        'weibo'   => 'http://www.weibo.com/u/2681234077/',
        'e-mail'  => 'mailto:admin@drakframe.com',
        'laravel' => 'https://laravel.com/',
    ],
    
    /**
     * 博客footer部分链接部分
     */
    'footer_urls' => [
        'WordPress主站' => '//www.drakframe.com/',
    ],

    // 首页显示预览字数
    'preview_length' => '500',
    // 文章一页展示多少条
    'display_item' => '5',

    'wechat' => [
        'user_openid' => env('WECHAT_USER_OPENID'),
        'template' => env('WECHAT_TEMPLATE'),
    ],
];
