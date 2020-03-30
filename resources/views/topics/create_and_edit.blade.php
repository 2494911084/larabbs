@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h1>
          @if($topic->id)
            帖子更新
          @else
            帖子发布
          @endif
        </h1>
      </div>

      <div class="card-body">
        @if($topic->id)
          <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8" >
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('common.error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                	<label for="title-field">标题</label>
                	<input class="form-control" autocomplete="off" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" />
                </div>
                <div class="form-group">
                    <label for="category_id-field">分类</label>
                    <select name="category_id" id="category_id-field" class="form-control">
                        <option value="" disabled hidden selected >请选择分类</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                	<label for="body-field">内容</label>
                	<textarea name="body" id="body-field" class="form-control" rows="3">{{ old('body', $topic->body ) }}</textarea>
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
