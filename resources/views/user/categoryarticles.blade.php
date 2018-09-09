@extends('user.layouts.app')
@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','News04')
@section('sub-heading',$title)
@section('main-content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <select class="itemName form-control" style="width:100%; margin-bottom: 10px" name="itemName"></select>

            @foreach($articles as $article)
                    <div class="post-preview">
                        <br>
                        <a href="{{route('article',$article->slug)}}">
                            <h5 class="post-subtitle">
                                {{$article->title}}
                            </h5>
                            <h6 class="post-subtitle">
                                {{$article->subtitle}}
                            </h6>
                        </a>
                        <p class="post-meta">Posted by
                            <a href="#">Start Bootstrap</a>
                            {{ $article->created_at->diffForHumans() }}</p>
                    </div>
                    <hr>
            @endforeach
            <!-- Pager -->
                    <div class="clearfix">

                        {{ $articles->links('vendor.pagination.custom') }}


                    </div>
            </div>
        </div>
    </div>

    <hr>
@endsection