<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://use.fontawesome.com/4e5ef8f80f.js"></script>
        <title>Zero的胡言乱语</title>

        <!-- Fonts -->
        <!--<link href="https://fonts.useso.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <link href="/css/app.css" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .header {
                text-align: center;
                border-bottom: 1px solid #00b0cc;
                margin: 3.5% auto 0;
                padding-bottom: 1%;
            }
            .content {
                border-bottom: 1px solid #00b0cc;
                text-align: center;
                margin: 3.5% auto 0;
                padding-bottom: 1%;
            }
            .title {
                font-family: cursive, Arial,  Helvetica, sans-serif, "宋体";
                font-size: 84px;
            }
            .subtitle {
                font-family: cursive, Arial, Helvetica, sans-serif, "宋体";
                font-size: 32px;
            }

            .content-title > a{
                font-size: 20px;
                text-decoration: none;
                color: #636b6f;
            }

            .navi > a{
                font-family: cursive, Arial, Helvetica, sans-serif, "宋体";
                color: #636b6f;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .paginator {
                text-align: center;
                margin: 3.5% auto 0;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="header">
                <div class="title">
                    Zero的胡言乱语
                </div>
                <div class="subtitle m-b-md">
                    recoding, learning
                </div>
                <div class="navi">
                    <a href="http://www.weibo.com/u/2681234077/">weibo</a>
                    <a href="mailto:admin@drakframe.com">E-MAIL</a>
                    <a href="https://github.com/laravel/laravel">Laravel</a>
                </div>
            </div>

            @foreach($indexPosts as $post)
                <div class="content">
                    <div class="content-title m-b-md"><a href="/post/{{$post->id}}">{{ $post->title }}</a></div>
                    <div>{{ $post->content }}</div>
                    <p>
                        {{ $post->created_at }}
                        发表于 {{ (new Carbon($post->created_at))->diffForHumans() }}
                         <a href="/user/{{ $post->user->id }}">{{ $post->user->nickname }}</a>
                         <i class="fa fa-thumbs-o-up" aria-hidden="true">{{ $post->like }}</i> 
                         <i class="fa fa-thumbs-o-down" aria-hidden="true">{{ $post->unlike }}</i> 
                    </p>
                </div>
            @endforeach
            <div class="paginator">
                {{ $indexPosts->links('vendor.pagination.default') }}
            </div>
        </div>
    </body>
</html>
