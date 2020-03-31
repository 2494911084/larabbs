@extends('layouts.app')

@section('description', $topic->slug)

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
                @can('make', $topic)
                <hr>
                <div class="mt-4">
                    <a href="{{ route('topics.edit', $topic->id) }}" type="button" class="btn btn-secondary">编辑</a>
                    <form onsubmit="return confirm('确认删除？');" action="{{ route('topics.destroy', $topic->id) }}" style="display: inline;" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary">删除</button>
                    </form>
                </div>
                @endcan
            </div>
        </div>
        <hr>
        {{-- 回复数据 --}}
        <div class="card">
            <div class="card-body">
                @include('shared._errors')
                <div>
                    <form action="{{ route('replies.store') }}" method="post">
                        @csrf
                      <div class="form-group">
                        <textarea class="form-control" name="content" rows="3" placeholder="请发布您的回复"></textarea>
                      </div>
                      <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                      <div class="mt-2">
                          <button type="submit" class="btn btn-success btn-sm">回复</button>
                      </div>
                    </form>
                </div>
                <hr>
                <div class="mt-2">
                    @include('topics._replies', ['replies' => $topic->replies()->created()->with(['user', 'topic'])->paginate()])
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
