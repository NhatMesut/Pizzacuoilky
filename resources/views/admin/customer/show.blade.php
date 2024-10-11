@extends('Admin.layouts.app')
@section('title', 'Thông tin cá nhân')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Cá Nhân</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Quản Lý Cá Nhân</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="card card-default">
            <!-- /.card-header -->
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Họ Tên</label>
                                <input type="text" class="form-control"
                                    id="name" name="name" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Số Điện Thoại</label>
                                <input type="text" class="form-control"
                                    id="phone" name="phone" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Email</label>
                                <input type="text" class="form-control"
                                    id="email" name="email" disabled>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Địa Chỉ</label>
                                <input type="text" class="form-control"
                                    id="address" name="address" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <a class="btn btn-success mr-2" href="{{ route('admin.customer.index') }}">Quay Lại</a>
                        <button type="submit" class="btn btn-danger ban" style="display: none;">Cấm Khách Hàng</button>
                        <button type="submit" class="btn btn-primary unban" style="display: none;">Cho Hoạt Động</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('css')
<style>
    .form-control:disabled, .form-control[readonly] {
        background-color: white;
        opacity: 1;
    }
</style>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var id = window.location.search.split('id=')[1];
        function fetchData() {
            $.ajax({
                url: `{{ $api_url }}user/${id}/`,
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $('#name').val(response.customer.name);
                    $('#email').val(response.email);
                    $('#phone').val(response.customer.phone);
                    $('#address').val(response.customer.address);

                    if (response.status === 1) {
                        $(".ban").css('display', 'block');
                    }else{
                        $(".unban").css('display', 'block');
                    }

                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            // Retry the fetch data request with the new token
                            fetchData();
                        });
                    } else {
                        window.location.href = '{{ route('admin.customer.index') }}';
                    }
                }
            });
        }

        fetchData();

        $('form').on('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách mặc định

            const formData = new FormData(this);

            function update() {
                $.ajax({
                    url: `{{ $api_url }}user/${id}/block/`,
                    type: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 5000
                        };
                        toastr.success('Cập nhật trạng thái người dùng thành công!', 'Thành Công');
                        if (response.user.status === 1) {
                            $(".ban").css('display', 'block');
                            $(".unban").css('display', 'none');
                        }else{
                            $(".unban").css('display', 'block');
                            $(".ban").css('display', 'none');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            refreshToken().done(function() {
                                // Retry the update request with the new token
                                update();
                            });
                        } else if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;
                            for (var key in errors) {
                                if (errors.hasOwnProperty(key)) {
                                    toastr.options = {
                                        closeButton: true,
                                        progressBar: true,
                                        positionClass: 'toast-top-right',
                                        timeOut: 5000
                                    };
                                    errors[key].forEach(function(error) {
                                        toastr.error(error, 'Thất Bại');
                                    });
                                }
                            }
                        } else {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                positionClass: 'toast-top-right',
                                timeOut: 5000
                            };
                            toastr.error('Cập nhật trạng thái người dùng thất bại!', 'Thất Bại');
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
                }).fail(function(xhr) {
                    // Clear localStorage and redirect to login
                    localStorage.removeItem('access_token');
                    localStorage.removeItem('refresh_token');
                    window.location.href = '{{ route('admin.login') }}'; // Replace with your login route
                });
            }
            
            update();
        });
    });
</script>
@endsection
