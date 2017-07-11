<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Whoops! 页面不见了</title>

    <style>
        @import url('../../../css/Source Sans Pro.css');
        body {
            background-image: url('../../../img/background.jpg');
            background-size: cover;
            background-repeat: space;
            margin: 0;
            padding: 0;
            font-family: -apple-system, system-ui, 'Source Sans Pro', "Microsoft YaHei", sans-serif;
            color: #AFD9CB;
        }
        div.infomation {
            position: absolute;
            top: 20px;
            width: 100%;
            text-align: center;
            z-index: 2;
        }
        h2 {
            font-weight: normal;
        }
        a {
            color: #118094;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="infomation">
        <h1>404 Not Found</h1>
        <h2>抱歉，看来你找错页面了</h2>
        <p>
            <a href="{{ url('/') }}">返回首页</a>
            或者
            <a href="mailto:admin@drakframe.com">联系我</a>
        </p>
    </div>
</body>
</html>