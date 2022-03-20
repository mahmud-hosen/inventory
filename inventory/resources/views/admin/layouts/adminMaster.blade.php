
<!DOCTYPE html>
<html>

<head>
    @include('admin.layouts.admin_header')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper" id="app">

    @include('admin.layouts.admin_sidebar')
   
    <!-- Content Wrapper. Contains page content -->
     <router-view></router-view>
    <!-- /.content-wrapper -->
   
    <!-- Footer Start -->
    @include('admin.layouts.admin_footer')
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
    
  <!-- Script File -->
    @include('admin.layouts.admin_script')
 
</body>

</html>

