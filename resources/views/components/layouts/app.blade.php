<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ asset('backend/plugins/toastr/toastr.css') }}">
  <livewire:styles />
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  @include('components.layouts.partials.navbar')
  <!-- /.navbar --> 

  <!-- Main Sidebar Container -->
  @include('components.layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    {{ $slot }}
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('components.layouts.partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('backend/plugins/toastr/toastr.min.js')}}"></script>
<script>
    window.addEventListener('add-new-user-modal',event=>{
        $("#newuserModal").modal("show");
    });
    
    $(document).ready(function() {
      toastr.options = {
        "positionClass":"toast-bottom-right",
        "progressBar" : true
      }
      window.addEventListener('add-new-user-modal-hide',event=>{
        $("#newuserModal").modal('hide');
        toastr.success(event.detail[0].message,'Success!');
      });    

      window.addEventListener('edit-user-modal',event=>{
        $("#newuserModal").modal("show");
      });

      window.addEventListener('show-delete-confirmation',event=>{
          $("#userdeleteConfirmation").modal("show");
      });

      window.addEventListener('hide-delete-confirmation',event=>{
        $("#userdeleteConfirmation").modal('hide');
        toastr.success(event.detail[0].message,'Success!');
      });  

      

    
      
    });
</script>

<livewire:scripts />
</body>
</html>
