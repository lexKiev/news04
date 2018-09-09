@extends('admin.layouts.app')

@section('headSection')
    <link rel="stylesheet"
          href="{{ asset('admin//bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Article Management
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Blank page</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Articles</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="box-header">
                        @can('post.create', Auth::user())
                            <a href="{{ route('post.create') }}" class="btn btn-success pull-right">Add New Article</a>
                        @endcan
                    </div>
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Slug</th>
                                <th>Created at</th>
                                @can('post.update', Auth::user())
                                    <th>Edit</th>
                                @endcan
                                @can('post.delete', Auth::user())
                                    <th>Delete</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->subtitle }}</td>
                                    <td>{{ $article->slug }}</td>
                                    <td>{{ $article->created_at }}</td>
                                    @can('post.update', Auth::user())
                                        <td><a href="{{ route('post.edit', $article->id) }}"><span
                                                        class="glyphicon glyphicon-edit"></span></a></td>
                                    @endcan
                                    @can('post.delete', Auth::user())
                                        <td>
                                            <form id="delete-form-{{ $article->id}}"
                                                  action="{{ route('post.destroy', $article->id) }}" method="post"
                                                  style="display: none">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                            </form>
                                            <a href="" onclick="
                                                    if (confirm('Are you sure you want to delete this?'))
                                                    {
                                                    event.preventDefault();document.getElementById('delete-form-{{ $article->id}}').submit();
                                                    }
                                                    else {
                                                    event.preventDefault()
                                                    }">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>

                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Sub Title</th>
                                <th>Slug</th>
                                <th>Created at</th>
                                @can('post.update', Auth::user())
                                    <th>Edit</th>
                                @endcan
                                @can('post.delete', Auth::user())
                                    <th>Delete</th>
                                @endcan
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <!-- /.box-body -->
                <!-- /.box-body -->
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('footerSection')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(function () {
            $('#example1').DataTable()
        })
    </script>
@endsection