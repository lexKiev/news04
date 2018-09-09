@extends('user.layouts.app')

@section('bg-img',Storage::disk('local')->url($article->img))
@section('title',$article->title)
@section('sub-heading',$article->subtitle)



@section('main-content')

    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    {{--creation time--}}
                    <small>Created {{ $article->created_at->diffForHumans() }}</small>

                    {{--showing all categories for this article--}}
                    @foreach($article->categories as $category)
                        <a href="{{route('category',$category->slug)}}">
                            <small class="pull-right"
                                   style="margin-right:10px; border-radius:  5px; border: 1px solid gray; padding: 5px">
                                {{  $category->name }}
                            </small>
                        </a>
                    @endforeach

                    {{--showing article body--}}
                    {!! htmlspecialchars_decode($article->body) !!}
                    @if($isAnalytic)
                        <div class="card text-center" style="margin-bottom: 30px">
                            <div class="card-body">
                                <h5 class="card-title">Please login</h5>
                                <p class="card-text">You must be a registered user to read complete article</p>
                                <a href="{{ Route('login') }}" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    @endif
                    {{--showing all tags for this article--}}
                    <hr>
                    <br>
                    <div id="likeblock" class="pull-right">
                        <a href="#" id="1" class="like" @if($article->likedByUser)style="color: green" @endif>
                            <small>{{ $article->like }}</small>
                            <i class="fa fa-thumbs-up"></i>
                        </a>
                        <a href="#" id="0" class="like" @if($article->dislikedByUser)style="color: red" @endif>
                            <small>{{ $article->dislike }}</small>
                            <i class="fa fa-thumbs-down"></i>
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 mx-auto">
                            <h6>Tag Cloud</h6>

                            @foreach($article->tags as $tag)
                                <a href="{{route('tag',$tag->slug)}}">
                                    <small class="pull-left"
                                           style="margin-right:10px; border-radius:  5px; border: 1px solid gray; padding: 5px">
                                        {{ $tag->name }}
                                    </small>
                                </a>

                            @endforeach
                        </div>
                    </div>


                    <div class="row" id="comment-block">
                        <div class="col-lg-12 col-md-12 mx-auto">
                            <br>
                            @include('shared.messages')
                            <h6>Commentaries:</h6>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 mx-auto">
                                    @if(Auth::user())
                                        <form action="{{route('comment',$article->id)}}" method="post"
                                              class="write-new">
                                            {{csrf_field()}}
                                            <textarea placeholder="Write your comment here" name="comment"></textarea>
                                            <div>
                                                <button type="submit">Submit</button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="card text-center " style="margin-bottom: 30px">
                                            <div class="card-body">
                                                <h5 class="card-title g-font-size-12">Please login</h5>
                                                <p class="card-text g-font-size-12">You must be a registered user to
                                                    leave a commentary</p>
                                                <a href="{{ Route('login') }}" class="btn btn-primary g-font-size-12">Login</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($comments)
                                @foreach($comments as $comment)
                                    <div class="media g-mb-30 media-comment">
                                        <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"
                                             src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                             alt="Image Description">
                                        <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
                                            <div class="g-mb-15">
                                                <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->name }}</h5>
                                                <span class="g-color-gray-dark-v4 g-font-size-10">{{ $comment->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="g-font-size-13 comment-text">
                                                {{ $comment->comment }}
                                            </p>
                                            <ul class="list-inline d-sm-flex my-0 g-font-size-12"
                                                id="commentLikeBlock{{$comment->id}}">
                                                <li class="list-inline-item g-mr-20">

                                                    <a class="commentLike u-link-v5 g-color-gray-dark-v4 g-color-primary--hover"
                                                       @if($comment->likedByUser) style="color: green" @endif
                                                       href="{{route('commentlike',$comment->id)}}" id="1" name="">
                                                        <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
                                                        {{$comment->like}}
                                                    </a>
                                                </li>
                                                <li class="list-inline-item g-mr-20">
                                                    <a class="commentLike u-link-v5 g-color-gray-dark-v4 g-color-primary--hover"
                                                       @if($comment->dislikedByUser)style="color: red" @endif
                                                       href="{{route('commentlike',$comment->id)}}" id="0">
                                                        <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3 "></i>
                                                        {{$comment->dislike}}
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div><br>This article viewed:
                        <span id="totalViews"></span>
                    </div>
                    <div>Currently watching:
                        <span id="currentrlyViews"></span>
                    </div>
                </div>

            </div>

        </div>
    </article>


    <hr>
@endsection

@section('footerSection')

    <script>
        var urlLogin = '{{ route('login')}}';
        var token = '{{ csrf_token() }}';
        var urlLike = '{{ route('like', $article->slug) }}';
        var urlVisit = '{{ route('visit',$article->slug) }}'

    </script>

@endsection
