  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/admin/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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
        <li class="treeview">
          <a href="{{ url('/home') }}">
            <i class="fa fa-pencil"></i> <span>Blog</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('backend.blog.index') }}"><i class="fa fa-circle-o"></i>All Post</a></li>
            <li><a href="{{ route('backend.blog.create') }}"><i class="fa fa-circle-o"></i>Add New</a></li>
          </ul>
        </li>
        @if(check_user_permissions(request(), "Categories@index"))
        <li>
          <a href="{{ route('backend.categories.index') }}"><i class="fa fa-folder"></i> <span>Category</span></a>
        </li>
        @endif
        @if(check_user_permissions(request(), "Users@index"))
        <li>
          <a href="{{ route('backend.users.index') }}"><i class="fa fa-users"></i> <span>Users</span></a>
        </li>
        @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>