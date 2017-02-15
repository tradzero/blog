<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>管理后台</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
  <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/adminlte/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/adminlte/css/skins/skin-blue.min.css">
  <link href="http://cdn.bootcss.com/nprogress/0.2.0/nprogress.min.css" rel="stylesheet">
  <style>
    [v-cloak] {
        display: none;
    }
  </style>
  @yield('style')

  <script src="/adminlte/jQuery/jquery-2.2.3.min.js"></script>
  <script src="http://cdn.bootcss.com/nprogress/0.2.0/nprogress.min.js"></script>
  <script src="/js/admin.js"></script>
  <!--[if lt IE 9]>
  <script src="//cdn.bootcss.com/html5shiv/3.7.3/html5shiv-printshiv.js"></script>
  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
   @include('admin/component/header')
   @include('admin/component/sidebar')
   
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        @yield('title')
        <small>@yield('subtitle')</small>
      </h1>
    </section>

    <section class="content">
        {{-- @if (session()->has('flash_notification.message'))
            <div class="alert alert-{{ session('flash_notification.level') }}">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                {!! session('flash_notification.message') !!}
            </div>
        @endif --}}
        @yield('content')
    </section>
  </div>
  
  @include('admin.component.footer')
</div>

<script src="/bootstrap/js/bootstrap.min.js"></script>
<script src="/adminlte/js/app.min.js"></script>
@yield('script')
</body>
</html>
