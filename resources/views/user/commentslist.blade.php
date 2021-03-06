@extends('user.layouts.app')
@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','News04')
@section('sub-heading','Module 04')
@section('main-content')
    <div class="row">
        <div class="col-lg-8 ">
    @foreach($comments as $comment)

<div class="media g-mb-30 media-comment">
    <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
    src="https://bootdey.com/img/Content/avatar/avatar7.png"
    alt="Image Description">
    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
        <div class="g-mb-15">
            <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->user->name }}</h5>
            <span class="g-color-gray-dark-v4 g-font-size-10">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <p class="g-font-size-13 comment-text">
            {{ $comment->comment }}
        </p>

    </div>
</div>
    @endforeach
        </div>
    </div>
@endsection