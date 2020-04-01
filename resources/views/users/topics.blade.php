@if (count($topics))

<ul class="list-group list-group-flush">
@foreach ($topics as $topic)
  <li class="list-group-item"><a href="{{ route('topics.show', $topic->id) }}" class="text-secondary">{{ $topic->title }}</a>
    <span class="float-right text-secondary">{{ $topic->reply_count }} 回复 <strong>·</strong> {{ $topic->created_at->diffForHumans() }}</span>
  </li>
@endforeach
</ul>

<div class="mt-3 ml-3">
    {!! $topics->appends(Request::except('page'))->links() !!}
</div>

@else
    <div class="alert alert-info">暂无数据</div>
@endif
