@extends('Admin.layouts.app')
@section('title', 'Thêm kích thước Pizza')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Kích Thước Pizza</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.size.index') }}">Quản Lý Kích Thước Pizza</a></li>
                    <li class="breadcrumb-item active">Thêm Kích Thước Pizza</li>
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
                <form id="update-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Tên Kích Thước</label>
                                <input type="text" class="form-control" id="name" placeholder="Kích thước bánh Pizza"
                                    name="name">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('admin.size.index') }}">Quay Lại</a>
                    <button type="submit" class="btn btn-primary">Thêm Kích Thước Pizza</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách mặc định

            const formData = new FormData(this);

            function create() {
                $.ajax({
                    url: `{{ $api_url }}sizes/`,
                    type: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 5000
                        };
                        window.location.href = '{{ route('admin.size.index') }}'
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            refreshToken().done(function() {
                                // Retry the update request with the new token
                                create();
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
                            toastr.error('Thêm kích thước Pizza thất bại!', 'Thất Bại');
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

            create();
        });
    });
</script>
@endsection
