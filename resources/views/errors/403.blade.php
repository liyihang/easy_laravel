@extends('layouts.default')
@section('title', '403 错误')

@section('content')
    <div class="jumbotron">
        <h1>你想搞事情啊</h1>
        <p class="lead">
            {{-- {{ $exception->getMessage() ? $exception->getMessage(): "禁止访问 Permission Denied" }} --}}
            <img src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1534331833200&di=e7afa359f48cf0e59c2490b40d1950f1&imgtype=0&src=http%3A%2F%2Fimg.tukexw.com%2Fimg%2Fc1ed2c036a8e5589.jpg" alt="">
        </p>
        <p>
            <a class="btn btn-lg btn-success" href="{{ route('home') }}" role="button">返回首页</a>
        </p>
    </div>
@stop