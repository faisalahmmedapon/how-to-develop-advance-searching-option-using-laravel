<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Backend  @yield('title') </title>
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/adminlte.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/app.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/fontawesome.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/dataTables.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/assets/css/toastr.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="{{asset('backend')}}/plugins/select2/select2.min.css"  />


    @yield('add_css_in_main_css_place')
</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

 @include('backend.layouts.partials.header')

    @include('backend.layouts.partials.siteber')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    @include('backend.layouts.partials.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('backend')}}/assets/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('backend')}}/assets/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backend')}}/assets/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend')}}/assets/js/adminlte.js"></script>



<!-- DataTable -->
<script src="{{asset('backend')}}/assets/js/datatables.min.js"></script>
<script>
    $(document).ready(function () {
        $('.dataTable').DataTable();
    });
</script>
<!-- DataTable -->





<!-- No image -->
<script src="{{asset('backend')}}/plugins/noimage/no-image.js"></script>

<!--Product Default image one -->
<script>
    $(document).ready(function() {
        $('#defaultImage').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showDefaultImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>



<!-- Toastr -->
<script src="{{asset('backend')}}/assets/js/toastr.min.js"></script>
<script>
    @if(Session::has('message'))
    var type = "{{Session::get('alert-type','info')}}"

    switch (type) {
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
    @endif
</script>
<!-- Toastr -->

<!-- Summernote -->
<script src="{{asset('backend')}}/plugins/summernote/summernote-bs4.min.js"></script>

<script>
    $(document).ready(function () {
        $('.summernote').summernote();
    });
</script>




<!-- Sweetalert -->
<script src="{{asset('backend')}}/plugins/sweetalert/sweetalert2@9.js"></script>
<script src="{{asset('backend')}}/plugins/sweetalert/sweetalertjs.js"></script>



<!-- select2 -->
<script src="{{asset('backend')}}/plugins/select2/select2.min.js"></script>



<!-- select2 -->
<script>
    $(document).ready(function() {
        $('.myselect2').select2();
    });
</script>



@yield('add_js_in_main_js_place')

</body>
</html>
