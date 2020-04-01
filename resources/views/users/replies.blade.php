@if (count($replies))

<ul class="list-group list-group-flush">
@foreach ($replies as $reply)
  <li class="list-group-item">
    <a href="{{ route('topics.show', $reply->topic_id) }}">{{ $reply->topic->title }}</a>
    <div class="mt-2 text-secondary">{!! $reply->content !!}</div>
    <div class="mt-2 text-secondary">回复于 {{ $reply->created_at->diffForHumans() }}</div>
  </li>
@endforeach
</ul>

<div class="mt-3 ml-3">
    {!! $replies->appends(Request::except('page'))->links() !!}
</div>

@else
    <div class="alert alert-info">暂无数据</div>
@endif
