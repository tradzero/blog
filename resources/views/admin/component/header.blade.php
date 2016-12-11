<header class="main-header">
    <a href="/admin" class="logo">
      <span class="logo-mini"><i class="fa fa-tachometer" aria-hidden="true"></i></span>
      <span class="logo-lg"><i class="fa fa-tachometer" aria-hidden="true"></i> 管理后台</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- 收起按钮 -->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle</span>
      </a>

      <!-- navibar 右侧下拉 -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        {{--  demo 
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- 显示的logo -->
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <!-- 下拉标题 -->
              <li class="header">You have 4 messages</li>
              <li>
                <ul class="menu">
                  <li>
                    <!-- 内容 -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="img/avatar.png" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- 显示更多按钮 -->
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> --}}

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-user-circle fa-lg" aria-hidden="true"></i>
              <span class="hidden-xs">{{ Auth::user()->nickname }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <i class="fa fa-user-circle fa-4x" aria-hidden="true"></i>
                <p>
                  {{ Auth::user()->nickname }}
                  <small>注册于 {{ Auth::user()->created_at->diffForHumans()  }}</small>
                </p>
              </li>
              {{-- <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <!-- 用户关联等关系 -->
                  </div>
                </div>
              </li> --}}
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/user/{{ Auth::user()->id }}" class="btn btn-default btn-flat">我的资料</a>
                </div>
                <div class="pull-right">
                  <form action="/logout" method="post">
                    {{ csrf_field() }}
                    <button class="btn btn-default btn-flat">登出</button>
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>