@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="text-center">作者：<a class="text-secondary" href="{{ route('users.show', $topic->user_id) }}">{{ $topic->user->name }}</a></div>
                <hr>
                <a href="{{ route('users.show', $topic->user_id) }}"><img src="{{ $topic->user->avatar }}" class="thumbnail img-fluid" width="300" alt=""></a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h1 class="text-center mt-3 mb-4">{{ $topic->title }}</h1>
                <p class="mt-2 text-secondary text-center">
                    {{ $topic->created_at->diffForHumans() }}
                    ·
                    {{ $topic->reply_count }} 回复
                </p>
                <div class="mt-2 topic-body">
                    {!! $topic->body !!}
                </div>
                <hr>
                <div class="mt-4">
                    <button type="button" class="btn btn-secondary">编辑</button>
                    <button type="button" class="btn btn-secondary">删除</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
