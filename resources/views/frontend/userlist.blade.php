<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>admin panel Laravel | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">


 <!-- navbar -->
 @include('plugin.navbar')
   <!-- /.navbar -->
 <!-- Sidebar -->
  @include('plugin.sidebar')
   <!-- /.Sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Users</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <table id="example" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                #ID
                            </th>
                            <th style="width: 20%">
                                Username
                            </th>
                            <th style="width: 8%" class="text-center">
                                Email
                            </th>
                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $perPage = 10;
    $pageLinkRange = 5; // จำนวนหน้าที่จะแสดงครั้งละ 5 หน้า
        $page = request()->get('page', 1);
        $lastPage = ceil($users->count() / $perPage);
    @endphp
                        
    @foreach ($users->forPage($page, $perPage) as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                <a>
                                    {{ $user->name }}
                                </a>
                                <br/>
                                <small>
                                    Update at 01.01.2019
                                </small>
                            </td>
                            <td>
                                <a>
                                    <center>
                                        {{ $user->email }}
                                    </center>
                                </a>
                            </td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="#">
                                    <i class="fas fa-folder"></i> View
                                </a>
                                <a class="btn btn-info btn-sm" href="#">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-sm" href="#">
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- แสดงปุ่ม Previous และ Next -->
                <div class="card-footer">
    <div class="float-right">
        @if ($page > 1)
            <a href="{{ request()->fullUrlWithQuery(['page' => $page - 1]) }}" class="btn btn-sm btn-primary">Previous</a>
        @endif

        @for ($i = max(1, $page - $pageLinkRange); $i <= min($page + $pageLinkRange, $lastPage); $i++)
            <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}" class="btn btn-sm btn-primary {{ $i === $page ? 'active' : '' }}">{{ $i }}</a>
        @endfor

        @if ($page < $lastPage)
            <a href="{{ request()->fullUrlWithQuery(['page' => $page + 1]) }}" class="btn btn-sm btn-primary">Next</a>
        @endif
    </div>
</div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


 <!-- script -->
 @include('plugin.script')
   <!-- /.script -->
</body>
</html>
