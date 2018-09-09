<div class="media g-mb-30 media-comment">
    {{--<img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15"--}}
         {{--src="https://bootdey.com/img/Content/avatar/avatar7.png"--}}
         {{--alt="Image Description">--}}
    <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
        <div class="g-mb-15">
            <h5 class="h5 g-color-gray-dark-v1 mb-0">{{ $comment->name }}</h5>
            <span class="g-color-gray-dark-v4 g-font-size-10">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <p class="g-font-size-13 comment-text">
            {{ $comment->comment }}
        </p>
        <ul class="list-inline d-sm-flex my-0 g-font-size-12" id="commentLikeBlock{{$comment->id}}">
            <li class="list-inline-item g-mr-20">
                <a class="commentLike u-link-v5 g-color-gray-dark-v4 g-color-primary--hover"
                   @if($comment->likedByUser) style="color: green" @endif href="{{route('commentlike',$comment->id)}}" id="1">
                    <i class="fa fa-thumbs-up g-pos-rel g-top-1 g-mr-3"></i>
                    {{$comment->like}}
                </a>
            </li>
            <li class="list-inline-item g-mr-20">
                <a class="commentLike u-link-v5 g-color-gray-dark-v4 g-color-primary--hover" @if($comment->dislikedByUser)style="color: red" @endif
                   href="{{route('commentlike',$comment->id)}}" id="0">
                    <i class="fa fa-thumbs-down g-pos-rel g-top-1 g-mr-3 "></i>
                    {{$comment->dislike}}
                </a>
            </li>
        </ul>
    </div>
</div>