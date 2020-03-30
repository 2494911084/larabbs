@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3">
        <div class="card">
          <img class="card-img-top" src="https://b-ssl.duitang.com/uploads/item/201608/27/20160827172726_GJfX2.jpeg" alt="Card image cap">
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
                <p>我的帖子，回复占位</p>
            </div>
        </div>
    </div>
</div>
@stop
