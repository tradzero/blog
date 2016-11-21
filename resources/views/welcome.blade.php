<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://use.fontawesome.com/4e5ef8f80f.js"></script>
        <title>Zero的胡言乱语</title>

        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet">
        <!-- Styles -->
        <script src="/js/jquery-3.1.1.js"></script>
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
                /*border-bottom: 1px solid #00b0cc;*/
                text-align: center;
                margin: 3.5% auto 0;
                padding-bottom: 1%;
            }
            .article-footer {
                padding-bottom: .5%;
                border-bottom: 1px solid #00b0cc;
                margin: 0 auto;
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
                    <a target="_blank" href="http://www.weibo.com/u/2681234077/">weibo</a>
                    <a target="_blank" href="mailto:admin@drakframe.com">E-MAIL</a>
                    <a target="_blank" href="https://laravel.com/">Laravel</a>
                </div>
            </div>

            @foreach($indexPosts as $post)
                <div class="content">
                    <div class="content-title m-b-md"><a href="/post/{{$post->id}}">{{ $post->title }}</a></div>
                    <div>{{ $post->content }}</div>
                </div>
                <div class="article-footer">
                    <p>
                         <span>{{ $post->created_at }} 发表于 {{ (new Carbon($post->created_at))->diffForHumans() }}</span>
                         <span><a href="/user/{{ $post->user->id }}">{{ $post->user->nickname }}</a></span>
                         <span>
                            <i class="fa fa-thumbs-o-up" aria-hidden="true" onclick="like($(this), {{ $post->id }}, 1)">{{ $post->like }}</i>
                            <i class="fa fa-thumbs-o-down" aria-hidden="true" onclick="like($(this), {{ $post->id }}, 0)">{{ $post->unlike }}</i>
                         </span>
                         
                    </p>
                </div>
            @endforeach
            <div class="paginator">
                {{ $indexPosts->links('vendor.pagination.default') }}
            </div>
        </div>
        <script>
            function like(obj ,id, value)
            {
                $.post({
                    url: "/post/like/" + id,
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        type: value
                    },
                    success: function(data) {
                        obj.text(value? data.like: data.unlike);
                        if(data.result){
                            alert(value? '点赞成功' : '踩成功');
                        }
                        else{
                            alert('一个文章只能赞/踩一次');
                        }
                    },
                    dataType: "json"
                });
            }
        </script>
    </body>
</html>
