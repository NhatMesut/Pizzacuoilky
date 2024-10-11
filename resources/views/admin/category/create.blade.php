@extends('Admin.layouts.app')
@section('title', 'Thêm loại Pizza')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Loại Pizza</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}">Quản Lý Loại Pizza</a></li>
                    <li class="breadcrumb-item active">Thêm Loại Pizza</li>
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
                                <label for="ten">Tên Loại Pizza</label>
                                <input type="text" class="form-control tenchinh" id="name" placeholder="Tên loại pizza"
                                    name="name">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="w-100">
                                    <label for="ten">Đường Dẫn</label>
                                    <span id="taoduongdan" class="float-right" style="cursor: pointer;">Tạo tự
                                        động?</span>
                                </div>
                                <input type="text" class="form-control" id="slug" placeholder="Đường dẫn"
                                    name="slug">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Hình Ảnh</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('admin.category.index') }}">Quay Lại</a>
                    <button type="submit" class="btn btn-primary">Thêm Loại Pizza</button>
                </form>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('script')
<script>
    function createSlug(str) {
        // Chuyển đổi tiếng Việt thành dạng slug
        str = str.toLowerCase().trim();
        str = str.replace(/\s+/g, '-'); // Thay thế khoảng trắng bằng dấu gạch ngang
        str = convertVietnameseToSlug(str); // Xử lý các dấu tiếng Việt

        return str;
    }

    function convertVietnameseToSlug(str) {
        var slug = str;

        // Xử lý dấu tiếng Việt
        slug = slug.replace(/[áàảãạăắằẳẵặâấầẩẫậ]/g, 'a');
        slug = slug.replace(/[éèẻẽẹêếềểễệ]/g, 'e');
        slug = slug.replace(/[íìỉĩị]/g, 'i');
        slug = slug.replace(/[óòỏõọôốồổỗộơớờởỡợ]/g, 'o');
        slug = slug.replace(/[úùủũụưứừửữự]/g, 'u');
        slug = slug.replace(/[ýỳỷỹỵ]/g, 'y');
        slug = slug.replace(/đ/g, 'd');

        return slug;
    }
</script>

<script>
    $(document).ready(function() {
        $('form').on('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách mặc định

            const formData = new FormData(this);

            function create() {
                $.ajax({
                    url: `{{ $api_url }}categories/`,
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
                        window.location.href = '{{ route('admin.category.index') }}'
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
                            toastr.error('Thêm loại Pizza thất bại!', 'Thất Bại');
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

        $('#taoduongdan').click(function(){
            if($(".tenchinh").val() == ""){
                toastr.options = {
	                closeButton: true,
	                progressBar: true,
	                positionClass: 'toast-top-right', // Vị trí hiển thị
	                timeOut: 5000 // Thời gian tự động đóng
	            };
	            toastr.error('Vui lòng nhập tên loại Pizza!', 'Thất Bại');
            }else{
                $("#slug").val(createSlug($(".tenchinh").val()))
            }
        })
    });
</script>
@endsection
