<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <title>您已被受邀注册{{ config('app.name') }}</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="panel">
                <div class="panel-heading panel-default text-center">
                    <p>以下是您的注册信息</p>
                </div>
                <div class="panel-body text-center">
                    <p>您的用户名：{{ $username }}</p>
                    @if($nickname)
                        <p>您的昵称：{{ $nickname }}</p>
                    @endif
                    <p>您的初始注册密码：{{ $registerPassword }}</p>
                    <p>您可以随时通过我们的用户系统更改您的昵称及密码</p>
                </div>
                <div class="panel-footer text-center">
                    Copyright © 2016 {{ config('app.name') }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>