@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tag Editor
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Editors</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit Tag</h3>
                        </div>
                        <!-- /.box-header -->
                    @include('shared.messages')
                    <!-- form start -->
                        <form role="form" action="{{ route('tag.update', $tag->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">

                                    <div class="form-group">
                                        <label for="name">Tag Title</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Enter tag title" value="{{$tag->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">Tag slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                               placeholder="Enter tag slug" value="{{$tag->slug}}">
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('tag.index') }}" class="btn btn-danger">Back</a>
                                    </div>
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection