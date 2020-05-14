@if(Session::get('admin')=='')
  <script type="text/javascript">
    window.location='/admin/sign-in';
  </script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <title>Blog Site | Admin | @yield('title')</title>

  <link rel="stylesheet" href="{{ url('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ url('admin/css/adminlte.min.css') }}">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jquery -->
  <script src="{{ url('admin/plugins/jquery/jquery.min.js') }}"></script>
  <!-- datatable -->
  <link rel="stylesheet" href="{{ url('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <script src="{{ url('admin/plugins/datatables/jquery.dataTables.js') }}"></script>
  <script src="{{ url('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
  <!-- sweetalert -->
  <script src="{{ url('admin/plugins/sweetalert/sweetalert.min.js') }}"></script>
  <!-- text editor -->
  <link rel="stylesheet" href="{{ url('admin/plugins/summernote/summernote-bs4.css') }}">
  <script src="{{ url('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>


  <script type="text/javascript">
    $.ajaxSetup({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
  </script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        @php
        $results = DB::table('admin')
          ->select('first_name')
          ->where('id', Session::get('admin'))
          ->get();
        @endphp

        @foreach ($results as $result)
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i> {{ $result->first_name }}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item text-center">
              <img src="{{ url('/images/admin/profile.png') }}" class="img-circle col-8 my-3">
            </a>
            <div class="dropdown-divider"></div>
            <div class="row">
              <div class="col-6" style="border-right: 1px solid #e9ecef">
                <a href="/admin/profile" class="dropdown-item dropdown-footer">Profile</a>
              </div>
              <div class="col-6">
                <a href="/admin-sign-out" class="dropdown-item dropdown-footer">Sign Out</a>
              </div>
            </div>
          </div>
        @endforeach
      </li>
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="/images/AdminLTELogo.png" alt="Site Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Blogs Admin</span>
    </a>

    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    
          <li class="nav-item">
            <a href="/admin/index" class="nav-link {{ $activePage == 'home' ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/manage-categories" class="nav-link {{ $activePage == 'categories' ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>Manage Categories</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/admin/manage-blogs" class="nav-link {{ $activePage == 'blogs' ? 'active' : '' }}">
              <i class="nav-icon fas fa-blog"></i>
              <p>Manage Blogs</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    @yield('content')
  </div>
</div>


<script src="{{ url('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('admin/js/adminlte.min.js') }}"></script>
</body>
</html>