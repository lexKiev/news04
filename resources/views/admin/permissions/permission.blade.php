@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Permission Editor
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
                            <h3 class="box-title">Add New Permission</h3>
                        </div>
                        <!-- /.box-header -->
                    @include('shared.messages')
                        <!-- form start -->
                        <form role="form" action="{{ route('permissions.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">

                                    <div class="form-group">
                                        <label for="name">Permission Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Enter permission name">
                                    </div>

                                    <div class="form-group">
                                        <label for="for">Permission for</label>
                                        <select name="for" id="for" class="form-control">
                                            <option selected disabled>Select Permission For</option>
                                            <option  value="user">User</option>
                                            <option  value="post">post</option>
                                            <option  value="other">other</option>
                                        </select>
                                    </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('permissions.index') }}" class="btn btn-danger">Back</a>
                            </div>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-->
            </div>
                    </form>
            <!-- ./row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection