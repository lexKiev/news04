@extends('user.layouts.app')

@section('bg-img',asset('/user/img/contact-bg.jpg'))
@section('title','Welcome!')
@section('sub-heading','')

@section('main-content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-10 mx-auto">
                    Welcome to News04, {{ Auth::user()->name }}!
                </div>
            </div>
        </div>
    </article>

    <hr>
@endsection

