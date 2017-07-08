@extends('admin.master')
@section('title')编辑文章@endsection
@section('content')
@include('editor::head')
    <div class="container-fluid">
        <div class="row">
            <form action="{{ URL::route('posts.update', $post->id) }}" method="POST">
                <div class="col-md-9">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        @if($errors->has('title'))
                            @include('admin.component.alert-danger', [ 'errors' => $errors->first('title') ])
                        @endif
                        <input class="form-control" name="title" type="text" placeholder="在此输入标题" value="{{ $post->title }}">
                    </div>
                    
                    <div class="form-group">
                        <div class="editor">
                            @if($errors->has('content'))
                                @include('admin.component.alert-danger', [ 'errors' => $errors->first('content') ])
                            @endif
                            <textarea name="content" class="form-control" id="myEditor"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">更新</button>
                        </div>
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
                                <select class="form-control" name="visible" value="{{ $post->visible }}" id="visible-select">
                                    <option value="0" @if($post->visible == 0) selected @endif>对所有人可见</option>
                                    <option value="1" @if($post->visible == 1) selected @endif>对认证用户可见</option>
                                    <option value="2" @if($post->visible == 2) selected @endif>隐藏(对自己可见)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            function heredoc(fn) {
                var resultText = fn.toString().split('\n').slice(1,-1).join('\n') + '\n';
                return resultText;
            }
            {{-- 注意下面不要有空格 否则数据将不准确 --}}
            var text = heredoc(function() {/*
{!! $post->content !!}
            */});
            myEditor.setVal(text);
            $('.editor__menu--edit').trigger('click');
            $('.editor__menu--live').trigger('click');
        });
    </script>
@endsection