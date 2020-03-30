@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-9">
        @if (isset($category))
        <div class="alert alert-info">
            {{ $category->name }}: {{ $category->description }}
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-pills">
                  <li class="nav-item">
                    <a class="nav-link active" href="{{ Request::url() }}?order=default">最近回复</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ Request::url() }}?order=created">最新发布</a>
                  </li>
                </ul>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    @foreach ($topics as $topic)
                      <li class="media">
                        <a href=""><img class="mr-3 img-thumbnail" src="{{ $topic->user->avatar }}" width="48" height="48" alt="Generic placeholder image"></a>
                        <div class="media-body text-secondary">
                          <div class="media-heading">
                            <a href="" class="text-secondary">{{ $topic->title }}</a>
                            <span class="float-right text-secondary">{{ $topic->reply_count }}</span>
                          </div>
                          <div class="media-body mt-2">
                            <a href="{{ route('categories.show', $topic->category_id) }}" class="text-secondary">{{ $topic->category->name }}</a>
                            <strong>·</strong>
                            <a href="{{ route('users.show', $topic->user_id) }}" class="text-secondary">{{ $topic->user->name }}</a>
                            <strong>·</strong>
                            <span>{{ $topic->created_at->diffForHumans() }}</span>
                          </div>
                        </div>
                      </li>
                      @if (!$loop->last)
                          <hr>
                      @endif
                    @endforeach
                </ul>
                <div>
                {!! $topics->appends(Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('topics.create') }}" class="btn btn-success btn-block">发布帖子</a>
            </div>
        </div>
    </div>
</div>

@endsection
