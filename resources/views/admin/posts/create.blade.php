@extends('admin.master')
@section('title')撰写新文章@endsection
@section('style')
    <link href="//cdn.bootcss.com/bootstrap-sweetalert/1.0.1/sweetalert.min.css" rel="stylesheet">
@endsection
@section('content')
@include('editor::head')
    <div class="container-fluid" id="app" v-cloak>
        <div class="row">
            <!-- main -->
            <form action="{{ URL::route('posts.store') }}" method="POST">
                <div class="col-md-9">
                    {{ csrf_field() }}
                    @if(count($errors))
                        @include('admin.component.alert-danger', ['errors' => $errors ])
                    @endif
                    <div class="form-group">
                        <input class="form-control" name="title" type="text" placeholder="在此输入标题" value="{{ old('title') }}">
                    </div>

                    <div class="form-group">
                        <div class="editor">
                            <textarea name="content" class="form-control" id="myEditor"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">发表</button>
                    </div>
                </div>
                <!-- toolbar -->
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">选项</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="form-control" for="visible-select">选择文章可见性</label>
                                <select class="form-control" name="visible" id="visible-select">
                                    <option value="0" selected>对所有人可见</option>
                                    <option value="1">对认证用户可见</option>
                                    <option value="2">隐藏(对自己可见)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">分类</h3>
                        </div>
                        <div class="box-body">
                            <div class="from-group">
                                <label class="form-control" for="tag-select">选择分类</label>
                            </div>
                            <div class="form-group" id="tag-select">
                                <div class="checkbox" v-for="tag in tags.tags">
                                    <label>
                                        <input type="checkbox" name="tags[]" :value="tag.id"> @{{ tag.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.bootcss.com/vue/2.1.10/vue.min.js"></script>
    <script src="//cdn.bootcss.com/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script>
        Vue.config.devtools = true;
        var vm = new Vue({
            el: '#app',
            data: {
                tags: [],
            },
            beforeCreate: function(){
                $.ajax({
                    url: '/api/tag',
                    async: true,
                    dataType: 'json',
                    success: function(data){
                        vm.tags = data;
                    },
                    error: function (){
                        vm.serverError();
                    },
                });
            },
            methods: {
                serverError: function () {
                    swal("抱歉，服务器出了点错", 
                    "抱歉，服务器出了点错, 请刷新后或稍后重试",
                    "warning");
                },
            },
        });
    </script>
@endsection