@extends('Admin.layouts.app')
@section('title', 'Danh sách nhân viên')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Nhân Viên</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Quản Lý Nhân Viên</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <input id="search-input" class="form-control col-md-2" type="text" placeholder="Tên nhân viên">
                        <button id="search-button" class="btn btn-primary ml-2 timkiem">Tìm Kiếm</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên</th>
                                    <th>Số Điện Thoại</th>
                                    <th>Địa Chỉ</th>
                                    <th>Chức Vụ</th>
                                    <th>Ngày Sinh</th>
                                    <th>Số CMND</th>
                                    <th>Ngày Bắt Đầu</th>
                                    <th>Lương Cơ Bản</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dữ liệu nhân viên sẽ được chèn vào đây bằng Ajax -->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item">
                                <a class="page-link" href="#"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        var currentPage = 1;
        var currentSearch = '';

        function fetchData(page, search = '') {
            $.ajax({
                url: `{{ $api_url }}employees?page=${page}&search=${search}`,
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    // Clear the table body
                    $('tbody').empty();

                    let rowNumber = (page - 1) * response.per_page + 1;

                    // Populate the table with data
                    response.data.forEach(item => {
                        let salary = Number(item.salary);
                        $('tbody').append(`
                            <tr>
                                <td>${rowNumber++}</td>
                                <td>${item.name}</td>
                                <td>${item.phone}</td>
                                <td>${item.address}</td>
                                <td>${item.position}</td>
                                <td>${item.date_of_birth}</td>
                                <td>${item.id_card_number}</td>
                                <td>${item.start_date}</td>
                                <td>${salary.toLocaleString('vi-VN')}đ / tháng</td>
                                <td>
                                    <a href="{{ route('admin.employee.update') }}/?id=${item.id}" class="btn btn-primary">Sửa</a>
                                    <a href="#" data-id="${item.id}" class="btn btn-danger delete-btn">Xóa</a>
                                </td>
                            </tr>
                        `);
                    });

                    // Clear pagination
                    $('.pagination').empty();

                    // Generate pagination links
                    response.links.forEach(link => {
                        if (link.url) {
                            $('.pagination').append(`
                                <li class="page-item ${link.active ? 'active' : ''}"><a class="page-link" href="#" data-url="${link.url}">${link.label}</a></li>
                            `);
                        } else {
                            $('.pagination').append(`
                                <li class="page-item disabled"><span class="page-link">${link.label}</span></li>
                            `);
                        }
                    });

                    // Handle pagination click events
                    $('.pagination .page-link').on('click', function(event) {
                        event.preventDefault();
                        const url = $(this).data('url');
                        const page = new URL(url).searchParams.get('page');
                        fetchData(page, currentSearch);
                    });

                    // Handle delete button click events
                    $('.delete-btn').on('click', function(event) {
                        event.preventDefault();
                        const id = $(this).data('id');
                        if (confirm('Bạn có chắc chắn muốn xóa nhân viên này?')) {
                            deleteAction(id);
                        }
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            fetchData(page, search);
                        });
                    } else {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 5000
                        };
                        toastr.error('Lấy danh sách nhân viên thất bại!', 'Thất Bại');
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

        function deleteAction(id) {
            $.ajax({
                url: `{{ $api_url }}employees/${id}`,
                method: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function() {
                    fetchData(currentPage, currentSearch); 
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            deleteAction(id);
                        });
                    } else {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 5000
                        };
                        toastr.error('Xóa nhân viên thất bại!', 'Thất Bại');
                    }
                }
            });
        }

        $('#search-button').on('click', function(event) {
            event.preventDefault();
            currentSearch = $('#search-input').val();
            currentPage = 1; // Reset to the first page
            fetchData(currentPage, currentSearch);
        });

        // Initial fetch
        fetchData(currentPage, currentSearch);
    });
</script>
@endsection