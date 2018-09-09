@extends('admin.layouts.app')

@section('headSection')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Commentary Editor
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Edit commentary</h3>
                        </div>
                        <!-- /.box-header -->
                    @include('shared.messages')
                    <!-- form start -->
                        <form role="form" action="{{ route('commentaries.update',$commentary->id) }}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            {{ method_field('PUT') }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Article Title</label>
                                        <input type="text" class="form-control" id="title" name="comment"
                                               placeholder="Enter title" value="{{$commentary->comment}}">
                                    </div>


                                </div>
                                <div class="col-lg-6">
                                    <br>
                                    <div class="checkbox pull-left">
                                        <label>
                                            <input type="checkbox" name="approved" value="1"
                                                   @if($commentary->approved == 1) checked @endif> Approve
                                        </label>
                                    </div>

                                </div>
                                <br>


                            </div>
                            <!-- /.box-body -->

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('commentaries.index') }}" class="btn btn-danger">Back</a>
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

@section('footerSection')
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>


@endsection