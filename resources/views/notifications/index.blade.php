@extends('layouts.app')

@section('content')
<div class="row mt-2">
    <div class="col-md-10 offset-md-1">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-1 mt-1">我的通知</h2>
        </div>
        <div class="card-body">
            <ul class="list-unstyled">
            @foreach ($notifications as $notification)
              <li class="media text-secondary">
                <a href="{{ route('users.show', $notification->data['reply_user_id']) }}"><img class="mr-3 img-thumbnail" src="{{ $notification->data['reply_user_avatar'] }}" width="50" height="50"></a>
                <div class="media-body">
                    <div class="media-heading">
                        <a href="{{ route('users.show', $notification->data['reply_user_id']) }}">{{ $notification->data['reply_user_name'] }}</a>
                        回复了
                        <a href="{{ $notification->data['topic_link'] }}">
                            {{ $notification->data['topic_title'] }}
                        </a>
                        <span class="float-right">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="media-body mt-2 ml-2">
                        {!! $notification->data['reply_content'] !!}
                    </div>
                </div>
              </li>
            @endforeach
            </ul>

            <div class="mt-2">
                {!! $notifications->links() !!}
            </div>
        </div>
    </div>
    </div>
</div>
@stop
