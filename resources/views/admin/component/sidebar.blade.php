<aside class="main-sidebar">
   <section class="sidebar">
      <ul class="sidebar-menu">
        <li class="header">功能</li>
        <li name="sidebar-index" class="active"><a href="/admin"><i class="fa fa-tachometer" aria-hidden="true"></i><span>首页</span></a></li>

        <li class="header">文章</li>
        <li name="sidebar-posts-create">
            <a href="/admin/posts/create"><i class="fa fa-paperclip" aria-hidden="true"></i> <span>新的文章</span></a>
        </li>
        <li name="sidebar-posts-index">
            <a href="/admin/posts"><i class="fa fa-file-text" aria-hidden="true"></i> <span>所有文章</span></a>
        </li>

        <li class="header">分类</li>
        <li name="sidebar-tags-index">
            <a href="/admin/tags"><i class="fa fa-tags" aria-hidden="true"></i> <span>所有分类</span></a>
        </li>
        <li name="sidebar-tags-create">
            <a href="/admin/tags/create"><i class="fa fa-tag" aria-hidden="true"></i> <span>新的分类</span></a>
        </li>

        <li class="header">评论</li>
        <li name="sidebar-comments-index">
            <a href="/admin/comments"><i class="fa fa-commenting" aria-hidden="true"></i> <span>评论</span></a>
        </li>

        <li class="header">用户</li>
        <li name="sidebar-users-index">
            <a href="/admin/users/index"><i class="fa fa-user" aria-hidden="true"></i> <span>管理用户</span></a>
        </li>
        <li name="sidebar-users-create">
            <a href="/admin/users/create"><i class="fa fa-user-circle" aria-hidden="true"></i> <span>新的用户</span></a>
        </li>
        <li name="sidebar-users-my">
            <a href="/admin/users/{{ Auth::user()->id }}"><i class="fa fa-vcard" aria-hidden="true"></i> <span>我的资料</span></a>
        </li>

        <li class="header">设置</li>
        <li name="siderbar-config">
            <a href="#"><i class="fa fa-gear" aria-hidden="true"></i> <span>设置</span></a>
        </li>
      </ul>
    </section>
</aside>