@foreach (['success', 'danger', 'warning', 'info', 'status'] as $element)
@if (session($element))
    <div class="alert alert-{{ $element }}" role="alert">
        {{ session($element) }}
    </div>
@endif
@endforeach
