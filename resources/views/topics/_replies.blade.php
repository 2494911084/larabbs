@if (count($replies) > 0)
<ul class="list-unstyled">
  @foreach ($replies as $reply)
  <li class="media">
    <a href="{{ route('users.show', $reply->user_id) }}"><img class="mr-3 img-thumbnail" src="{{ $reply->user->avatar }}" width="50" height="50" alt="Generic placeholder image"></a>
    <div class="media-body">
      <div class="media-heading text-secondary">
        <a href="{{ route('users.show', $reply->user_id) }}">{{ $reply->user->name }}</a> · {{ $reply->created_at->diffForHumans() }}
        <form id="delete_form" action="{{ route('replies.destroy', $reply->id) }}" style="display: inline;" class="float-right" method="post" onsubmit="return confirm('确认删除回复?');">
          @csrf
          @method('DELETE')
          <a onclick="$('#delete_form').submit()">删除</a>
        </form>
        {{-- <span class="float-right">删除</span> --}}
      </div>
      <div class="media-body text-secondary">
        {{ $reply->content }}
      </div>
    </div>
  </li>
  @if (!$loop->last)
    <hr>
  @endif
  @endforeach
</ul>

<div class="mt-2">
  {!! $replies->links() !!}
</div>
@else
<div class="alert alert-info">
  暂无数据~.~
</div>
@endif
