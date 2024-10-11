@extends('Admin.layouts.app')
@section('title', 'Thêm sản phẩm')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Sản Phẩm</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Quản Lý Sản Phẩm</a></li>
                    <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ten">Tên Sản Phẩm</label>
                                <input type="text" class="form-control tenchinh" id="name" placeholder="Tên sản phẩm"
                                    name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="w-100">
                                    <label for="ten">Đường Dẫn</label>
                                    <span id="taoduongdan" class="float-right" style="cursor: pointer;">Tạo tự
                                        động?</span>
                                </div>
                                <input type="text" class="form-control" id="slug" placeholder="Đường dẫn sản phẩm"
                                    name="slug">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ten">Số Lượng</label>
                                <input type="number" class="form-control tenchinh" id="quantity" placeholder="Số lượng"
                                    name="quantity">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="image">Loại Pizza</label>
                                <select name="category_id" id="category_id" class="form-control">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="image">Hình Ảnh</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Mô Tả Ngắn</label>
                                <textarea rows="3" name="short_description" id="short_description" class="form-control" placeholder="Mô tả ngắn"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ten">Mô Tả Chi Tiết</label>
                                <textarea id="detailed_description" placeholder="Mô tả chi tiết" name="detailed_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <a class="btn btn-success" href="{{ route('admin.product.index') }}">Quay Lại</a>
                    <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
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
        function fetchCategoryData() {
            $.ajax({
                url: `{{ $api_url }}categories/`,
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $("#category_id").empty();

                    response.data.forEach(item => {
                        $("#category_id").append(`<option value="${item.id}">${item.name}</option>`);
                    })
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            // Retry the fetch data request with the new token
                            fetchCategoryData();
                        });
                    }
                }
            });
        }

        fetchCategoryData();

        $('form').on('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách mặc định

            const formData = new FormData(this);

            function create() {
                $.ajax({
                    url: `{{ $api_url }}products/`,
                    type: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.location.href = '{{ route('admin.product.index') }}'
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
                            toastr.error('Thêm sản phẩm thất bại!', 'Thất Bại');
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
	            toastr.error('Vui lòng nhập tên sản phẩm!', 'Thất Bại');
            }else{
                $("#slug").val(createSlug($(".tenchinh").val()))
            }
        })
    });
</script>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#detailed_description'))
        .catch(error => {
            console.error(error);
        });
</script>

<style type="text/css">
  .ck-editor__editable {min-height: 300px;}
</style>
@endsection
