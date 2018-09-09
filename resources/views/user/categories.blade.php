@extends('user.layouts.app')
@section('bg-img',asset('user/img/home-bg.jpg'))
@section('title','News04')
@section('sub-heading','Module 04')
@section('main-content')
    <div class="container container-fluid">

        <div class="row" id="app">

            <div class="col-lg-10 col-md-10 col-sm-10 mx-auto">

                <ul>
                    @foreach($categories as $category)
                        <li>
                            <h4 class="post-title"><a href="{{route('category',$category->slug)}}"
                                                      class="badge badge-primary">{{ $category->name }}</a></h4>
                            @if($category->name == 'Analytics')
                                <a href="{{route('category',$category->slug)}}"
                                   class="badge badge-danger">Only for authorized users</a>
                                @elseif($category->name == 'Politics')
                                <a href="{{route('category',$category->slug)}}"
                                   class="badge badge-warning">Commentaries pre-moderation</a>
                                @endif
                            <br>
                            <span>Articles in this category: {{$category->countArticles}} </span>
                        </li>

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