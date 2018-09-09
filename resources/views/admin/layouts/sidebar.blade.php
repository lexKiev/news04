<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>News04</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{ route('post.index') }}"><i class="fa fa-circle-o"></i> Articles</a></li>
                    @can('post.commentaries',Auth::user())
                    <li class=""><a href="{{ route('commentaries.index') }}"><i class="fa fa-circle-o"></i> Commentaries</a></li>
                    @endcan
                    @can('post.category',Auth::user())
                    <li class=""><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
                    @endcan
                    @can('post.tag',Auth::user())
                    <li class=""><a href="{{ route('tag.index') }}"><i class="fa fa-circle-o"></i> Tags</a></li>
                    @endcan
                    @can('admin.view',Auth::user())
                    <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
                    <li class=""><a href="{{ route('roles.index') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
                    <li class=""><a href="{{ route('permissions.index') }}"><i class="fa fa-circle-o"></i> Permissions</a></li>
                    @endcan
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>