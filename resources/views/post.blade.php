<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>{{ $post['title'] }}</title>
        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/front.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/wysiwyg.css">
        <link href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="//cdn.bootcss.com/rainbow/1.2.0/themes/github.min.css" rel="stylesheet">
        
        <!-- Script -->
        <script src="/js/jquery-3.1.1.js"></script>
        <script src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="//cdn.bootcss.com/vue/2.1.4/vue.js"></script>

    </head>
<body>
    <div class="flex-center position-ref full-height" id="app" v-cloak>
        @include('component.loginbar')
        <!-- home -->
        <div class="top-left">
            <a class="navi" href="/"><i class="fa fa-home fa-5" aria-hidden="true"></i></a>
        </div>
        <!-- title -->
        <div class="header">
            <div class="postTitle">{{ $post['title'] }}</div>
        </div>
        <!-- content -->
        <div class="article">
            <div class="postInfo center">
                <!-- content's tag -->
                <div class="postTags">
                    @foreach($post['tags'] as $tag)
                        <a href="/tag/{{ $tag['id'] }}"><span class="label label-primary">{{ $tag['name'] }}</span></a>
                    @endforeach
                </div>
                <!-- post date -->
                <div class="postDate">
                    {{ $post['created_at'] }}
                </div>
            </div>
            <!-- content text -->
            <div class="wysiwyg">
                {!! $post['content'] !!}
            </div>
        </div>
        <!-- post info-->
        <blockquote>
            <p class="small">本文标签：@foreach($post['tags'] as $tag) <a href="/tag/{{ $tag['id'] }}">{{ $tag['name'] }}</a>  @endforeach </p>
            <p class="small">本文作者：{{ $post['user']['username'] }}</p>
            <p class="small">已有：@{{ post['like'] }} 人点赞 <button class="btn btn-default" @click="postLike('like', '0')"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button></p>
            <p class="small">已有：@{{ post['unlike'] }} 人点踩 <button class="btn btn-default" @click="postLike('like', '1')"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button></p>
        </blockquote>
        <!-- comments -->
        <div class="comments text-center">
            <div class="comment panel panel-default" v-for="(comment, index) in post.comments">
                <div class="panel-heading text-left">
                    <span :name="comment.id">
                        @{{ comment.user.nickname }} 评论：
                    </span>
                </div>
                <div  class="panel-body">
                    @{{ comment.comment }}
                </div>
                <div class="panel-footer text-left">
                    <button class="btn btn-default" @click="like(index, '0')" style="margin-right: 1%"><i class="fa fa-thumbs-o-up" aria-hidden="true">点赞：@{{ comment.like }}</i></button> 
                    <button class="btn btn-default" @click="like(index, '1')" style="margin-right: 1%"><i class="fa fa-thumbs-o-down" aria-hidden="true">踩：@{{ comment.unlike }}</i></button>
                    <span style="margin-right: 3%">评论于：@{{ comment.created_at }}</span>
                </div>
            </div>
            
            <!-- write comments -->
            <form action="/post/{{ $post['id'] }}/comment" method="post">
                {{ csrf_field() }}
                <textarea class="form-control" rows="10" placeholder="留下你的评论"></textarea>
                <p class="text-left"><button @click.prevent="submit()" style="margin-top: 1%" class="btn btn-primary btn-block" type="submit">提交</button></p>
            </form>
        </div>
        {{-- @include('component.footerbar') --}}
    </div>
<!-- highlight -->
@include('component.highlight')

<script>
    var vm = new Vue({
        el: "#app",
        data: {
            post: {
                id: {{ $post['id'] }},
                like: {{ $post['like'] }},
                unlike: {{ $post['unlike'] }}, 
                comments: {!!  json_encode($post['comments']) !!},
            },
            token: '{{ csrf_token() }}',
        },
        methods: {
            like: function(index, method) {
                var commentId = this.post.comments[index].id;
                var router = method == '0' ? 'like' : 'unlike'; 
                var that = this;
                $.ajax({
                    url: '/comment/' + commentId + '/' + 'like',
                    method: 'post',
                    data: {
                        _token: this.token,
                        _method: 'patch',
                        type: method,
                    },
                    success: function(data){
                        if(data.result){
                            that.post.comments[index].like = data.like;
                            that.post.comments[index].unlike = data.unlike;
                        }else{
                            alert('一个评论只能点赞、踩一次哦！');
                        }
                    },
                    dataType: "json",
                });
            },
            postLike: function(index, method) {
                var postId = this.post.id;
                var router = method == '0' ? 'like' : 'unlike'; 
                var that = this;
                $.ajax({
                    url: '/post/' + postId + '/' + 'like',
                    method: 'post',
                    data: {
                        _token: this.token,
                        _method: 'patch',
                        type: method,
                    },
                    success: function(data){
                        if(data.result){
                            that.post.like = data.like;
                            that.post.unlike = data.unlike;
                        }else{
                            alert('一个评论只能点赞、踩一次哦！');
                        }
                    },
                    dataType: "json",
                });
            },
            submit: function() {
                @if(Auth::check())
                    var authStatus = true;
                @else
                    var authStatus = false;
                @endif
                var commentData = $('textarea').val();
                var that = this;
                if(!authStatus){
                    alert('只有登陆用户才能发表评论');
                    return ;
                }
                $.ajax({
                    url: '/comment/' + this.post.id,
                    method: 'post',
                    data: {
                        _token: this.token,
                        content: commentData
                    },
                    success: function(data){
                        if(data.result){
                            alert('评论成功');
                            location.href="/post/" + that.post.id + "/#" + data.comment.id;
                        }
                    }

                });
            },
        },
    });
</script>
</body>
</html>