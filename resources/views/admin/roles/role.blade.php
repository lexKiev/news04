@extends('admin.layouts.app')

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Role Editor
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
                            <h3 class="box-title">Add New Role</h3>
                        </div>
                        <!-- /.box-header -->
                    @include('shared.messages')
                    <!-- form start -->
                        <form role="form" action="{{ route('roles.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-offset-3 col-lg-6">

                                    <div class="form-group">
                                        <label for="name">Role Title</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               placeholder="Enter role name">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <label for="name">Posts Permissions </label>
                                            @foreach($permissions as $permission)
                                                @if($permission->for == 'post')
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="permission[]"
                                                                   value="{{ $permission->id }}">{{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="name">User Permissions</label>
                                            @foreach($permissions as $permission)
                                                @if($permission->for == 'user')
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="permission[]"
                                                                   value="{{ $permission->id }}">{{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div class="col-lg-4">
                                            <label for="name">Other Permissions</label>
                                            @foreach($permissions as $permission)
                                                @if($permission->for == 'other')
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="permission[]"
                                                                   value="{{ $permission->id }}">{{ $permission->name }}
                                                        </label>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('roles.index') }}" class="btn btn-danger">Back</a>
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