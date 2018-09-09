@extends('user.layouts.app')
@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','News04')
@section('sub-heading','Module 04')
@section('main-content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <h4 style="color: green">Most commented articles:</h4>
                <br>
                @foreach($articles as $article)
                    <div class="post-preview">
                        <a href="{{route('article',$article->slug)}}">
                            <h4 >
                                {{$article->title}}
                            </h4>
                        </a>
                        <p class="post-meta">
                            Comments posted: {{$article->comments_count}}</p>
                    </div>
                    <hr>
            @endforeach
            <!-- Pager -->
                <br><br><br><br>
            </div>

            <div class="col-lg-8 col-md-10 mx-auto">
                <h4 style="color: blue">Most active users:</h4>
                <br>
                @foreach($users as $user)
                    <div class="post-preview">
                        <a href="{{route('usercomments',$user->id)}}">
                            <h4 >
                                {{$user->name}}
                            </h4>
                        </a>
                        <p class="post-meta">
                            Comments posted: {{$user->comments_count}}</p>
                    </div>
                    <hr>
            @endforeach
            <!-- Pager -->

            </div>
        </div>
    </div>


@endsection