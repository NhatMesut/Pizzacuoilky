<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('dist/img/AdminLTELogo.png') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script>
        if (!localStorage.getItem('access_token')) {
            window.location.href = '{{ route('admin.login') }}';
        }
    </script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Quản Lý Cửa Hàng</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item has-treeview menu-open">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Trang Chủ
                                </p>
                            </a>
                        </li>

                        <li class="nav-header">QUẢN LÝ MÓN ĂN</li>
                        
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fas fa-pizza-slice"></i>
                                <p>
                                    Bánh Pizza
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.product.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.product.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fas fa-compress"></i>
                                <p>
                                    Kích Thước
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.size.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.size.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fas fa-border-style"></i>
                                <p>
                                    Viền Bánh
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.border.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.border.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa-solid fas fa-window-minimize"></i>
                                <p>
                                    Topping Bánh
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.toppings.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.toppings.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-header">QUẢN LÝ CỬA HÀNG</li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.category.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-layer-group"></i>
                                <p>
                                    Loại Bánh Pizza
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.category.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.coupon.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-newspaper"></i>
                                <p>
                                    Mã Giảm Giá
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.coupon.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.coupon.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview customer-menu-list d-none">
                            <a href="{{ route('admin.employee.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-users"></i>
                                <p>
                                    Nhân Viên
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.employee.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Danh Sách</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.employee.create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Thêm Mới</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-header">QUẢN LÝ BÁN HÀNG</li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.order.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-clipboard-list"></i>
                                <p>
                                    Hóa Đơn
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.customer.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-user"></i>
                                <p>
                                    Khách Hàng
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">CÀI ĐẶT CHUNG</li>
                        <li class="nav-item has-treeview">
                            <a href="{{ route('admin.profile.index') }}" class="nav-link">
                                <i class="nav-icon fa-solid fa-lock"></i>
                                <p>
                                    Đổi Thông Tin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link logout">
                                <i class="nav-icon fa-solid fa-right-from-bracket"></i>
                                <p>
                                    Đăng Xuất
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper" style="min-height: 1203.31px;">
            @yield('content')
        </div>

        <footer class="main-footer">
            <strong>&copy; 2023-2024 - Trang dành cho <a href="#">Quản trị viên</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Phiên bản</b> 1.0.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @yield('css')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $(".logout").click(function(){
            localStorage.removeItem('access_token');
            localStorage.removeItem('refresh_token');
            localStorage.removeItem('role');
            window.location.href = '{{ route('admin.login') }}';
        });

        function checkAdmin(){
            // Gửi dữ liệu GET đến API
            $.ajax({
                url: '{{ $api_url }}user/profile',
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    if(response.user.role_id == 1){
                        $(".customer-menu-list").removeClass('d-none');
                    }

                    if(response.user.role_id == 3){
                        localStorage.removeItem('role');
                        window.location.href = '{{ route('web.customer.index') }}';
                    }else{
                        localStorage.setItem('role', response.user.role_id);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            // Retry the update request with the new token
                            checkAdmin();
                        });
                    }
                }
            });
        }

        function refreshToken() {
            return $.ajax({
                url: `{{ $api_url }}refresh`,
                method: 'POST',
                data: {
                    'refresh_token': localStorage.getItem('refresh_token')
                }
            }).done(function(response) {
                localStorage.setItem('access_token', response.access_token);
                localStorage.setItem('refresh_token', response.refresh_token);
            }).fail(function(xhr) {
                localStorage.removeItem('access_token');
                localStorage.removeItem('refresh_token');
                window.location.href = '/login'; // Replace with your login route
            });
        }

        checkAdmin();
    });
</script>
@yield('script')
