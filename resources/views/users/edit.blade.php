@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>编辑资料</h2>
            </div>

            <div class="card-body">
                @include('shared._errors')
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                  <div class="form-group">
                    <label for="exampleInputName">姓名</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" id="exampleInputName" aria-describedby="nameHelp" placeholder="Enter name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail">邮箱</label>
                    <input type="email" name="email" readonly value="{{ old('email', $user->email) }}" class="form-control" id="exampleInputEmail" placeholder="email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputIntroduction">个人简介</label>
                    <textarea name="introduction" id="exampleInputIntroduction" class="form-control" rows="3" placeholder="请输入个人简介">{{ old('introduction', $user->introduction) }}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary">保存</button>
                </form>
            </div>
        </div>
    </div>
@stop
