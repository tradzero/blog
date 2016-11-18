<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zero的胡言乱语</title>

        <!-- Fonts -->
        <!--<link href="https://fonts.useso.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->

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
                text-align: center;
            }
            .title {
                font-family: cursive, Arial,  Helvetica, sans-serif, "宋体";
                font-size: 84px;
            }
            .subtitle {
                font-family: cursive, Arial, Helvetica, sans-serif, "宋体";
                font-size: 32px;
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
                    <a href="mailto:admin@drakframe.com">E-Mail</a>
                    <a href="https://github.com/laravel/laravel">Laravel</a>
                </div>
            </div>

            <div class="content">
            </div>
        </div>
    </body>
</html>
