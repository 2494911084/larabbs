@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="{{ $user->avatar }}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-text"><strong>个人简介</strong></h5>
            <p class="card-text">{{ $user->introduction }}</p>
            <hr>
            <h5 class="card-text"><strong>注册于</strong></h5>
            <p class="card-text">{{ $user->created_at->diffForHumans() }}</p>
          </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="card">
            <div class="card-body">
                <h2>{{ $user->name }} <small>{{ $user->email }}</small></h2>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link {{ active_class(!if_query('type', 'reply')) }}" href="{{ Request::url() }}?type=default">我的帖子</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link {{ active_class(if_query('type', 'reply')) }}" href="{{ Request::url() }}?type=reply">我的回复</a>
                  </li>
                </ul>
                <div class="mt-2">
                    @if (if_query('type', 'reply'))
                    @include('users.replies', ['replies' => $user->replies()->created()->with(['user', 'topic'])->paginate(5)])
                    @else
                    @include('users.topics', ['topics' => $user->topics()->created()->with(['user', 'category'])->paginate(5)])
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop
