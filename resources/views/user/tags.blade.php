@extends('user.layouts.app')
@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','News04')
@section('sub-heading','Module 04')
@section('main-content')

    <div class="container">
        <div class="row" id="app">
            <div class="col-lg-8 col-md-10 mx-auto">

                <ul>
                    @foreach($tags as $tag)
                        <li>
                            <h5 class="post-subtitle"><a href="{{route('tag',$tag->slug)}}"
                                                      class="badge badge-primary">{{ $tag->name }}</a></h5>

                            <br>
                            <span>Articles in this category: {{$tag->countArticles}} </span>
                        </li>

                        <hr>
                    @endforeach
                </ul>
                <div class="clearfix">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>

    <hr>
@endsection