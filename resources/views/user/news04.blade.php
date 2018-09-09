@extends('user.layouts.app')
@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','News04')
@section('sub-heading','Module 04')
@section('main-content')


    <!-- Main Content -->

    <div class="container">


    </div>

    <div class="card-group">
        <div class="owl-carousel" style="margin-bottom: 10px;">

            @foreach($articles as $article)

                <div class="card" style="min-height: 200px; max-height: 200px">
                    <a href="{{route('article',$article->slug)}}" class="card-linking">

                    </a>
                    <div><img class="card-img-top img-responsive" src="{{Storage::disk('local')->url($article->img)}}"
                              alt="Card image cap"></div>

                    <div class="card-body">
                        <h6 class="card-title" style="">{{$article->title}}</h6>
                    </div>
                </div>
            @endforeach
        </div>

    </div>


    <div class="container">
        <div class="row" id="app">
            <div class="col-lg-8 col-md-10 mx-auto">

                <ul>
                    <li style="margin-bottom: 10px">
                        <select class="itemName form-control" style="width:100%; margin-bottom: 10px" name="itemName"></select>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <h4 class="post-title"><a href="{{route('category',$category->slug)}}"
                                                      class="badge badge-primary">{{ $category->name }}</a></h4>
                        </li>
                        <ul>
                            @foreach($collection[$category->slug] as $art)
                                <li>
                                    <div class="post-preview">
                                        <a href="{{route('article',$art->slug)}}">
                                            <img class="pull-left post-image" width="100px" height="70px"
                                                 src="{{Storage::disk('local')->url($art->img)}}" alt="{{$art->slug}}">
                                        </a>

                                        <a href="{{route('article',$art->slug)}}">
                                            <h5 class="post-subtitle">
                                                {{$art->subtitle}}
                                            </h5>
                                        </a>

                                        <p class="post-meta">
                                            Posted by
                                            <a href="#">Start Bootstrap</a>
                                            {{ $art->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </li>
                                <hr>

                            @endforeach
                        </ul>
                        <a href="{{route('category',$category->slug)}}">View more...</a>
                        <hr>

                    @endforeach
                </ul>
                <div class="clearfix">
                    {{--{{ $articles->links() }}--}}
                </div>
            </div>
        </div>
    </div>

    <hr>
@endsection
