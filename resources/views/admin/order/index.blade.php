@extends('Admin.layouts.app')
@section('title', 'Danh sách hóa đơn')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Quản Lý Hóa Đơn</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Trang Chủ</a></li>
                    <li class="breadcrumb-item active">Quản Lý Hóa Đơn</li>
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
                        <input id="search-input" class="form-control col-md-2" type="text" placeholder="Mã hóa đơn">
                        <select id="select-input" class="form-control col-md-2 ml-2">
                            <option value="">Chọn Trạng Thái</option>
                            <option value="1">Chờ Duyệt Đơn</option>
                            <option value="2">Đang Chế Biến</option>
                            <option value="3">Hoàn Tất</option>
                            <option value="0">Đã Hủy</option>
                        </select>
                        <button id="search-button" class="btn btn-primary ml-2 timkiem">Tìm Kiếm</button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Mã Hóa Đơn</th>
                                    <th>Khách Hàng</th>
                                    <th>Tổng Tiền</th>
                                    <th>Ngày Đặt</th>
                                    <th>Trạng Thái</th>
                                    <th>Nhân Viên Xử Lý</th>
                                    <th>Xác Nhận Thanh Toán</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                
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
                url: `{{ $api_url }}orders?page=${page}&search=${search}`,
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
                        let paymentText;
                        let statusText;

                        if (item.status === 1) {
                            statusText = "Chờ Duyệt Đơn";
                        } else if (item.status === 2) {
                            statusText = "Đang Chế Biến";
                        } else if (item.status === 3) {
                            statusText = "Hoàn Tất";
                        } else {
                            statusText = "Đã Huỷ"; 
                        }

                        let totalAmount = Number(item.total_amount);

                        if (item.payment === 0) {
                            $('tbody').append(`
                                <tr>
                                    <td>${rowNumber++}</td>
                                    <td>${item.order_code}</td>
                                    <td><a href="{{ route('admin.customer.show') }}?id=${item.customer.id}">${item.customer.name}</a></td>
                                    <td>${totalAmount.toLocaleString('vi-VN')}đ</td>
                                    <td>${item.created_at}</td>
                                    <td>${statusText}</td>
                                    <td>${item.employee ? item.employee.name : "<b>HIỆN CHƯA CÓ</b>"}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning pay-confirm-btn" data-id="${item.id}">Xác Nhận Thanh Toán</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.order.show') }}/?id=${item.id}" class="btn btn-primary">Xử Lý Hóa Đơn</a>
                                    </td>
                                </tr>
                            `);
                        } else if(item.payment === 1){
                            $('tbody').append(`
                                <tr>
                                    <td>${rowNumber++}</td>
                                    <td>${item.order_code}</td>
                                    <td><a href="{{ route('admin.customer.show') }}?id=${item.customer.id}">${item.customer.name}</a></td>
                                    <td>${totalAmount.toLocaleString('vi-VN')}đ</td>
                                    <td>${item.created_at}</td>
                                    <td>${statusText}</td>
                                    <td>${item.employee ? item.employee.name : "<b>HIỆN CHƯA CÓ</b>"}</td>
                                    <td>
                                        <a href="#" class="btn btn-default" style="cursor: not-allowed;" disabled>Đã Thanh Toán HĐ</a>
                                    </td>
                                    <td>
                                        ${item.status == 0 ? '<a href="#" class="btn btn-default" style="cursor: not-allowed;" disabled>Xử Lý Hóa Đơn</a>' : `<a href="{{ route('admin.order.show') }}/?id=${item.id}" class="btn btn-primary">Xử Lý Hóa Đơn</a>`}
                                    </td>
                                </tr>
                            `);
                        }else{
                            $('tbody').append(`
                                <tr>
                                    <td>${rowNumber++}</td>
                                    <td>${item.order_code}</td>
                                    <td><a href="{{ route('admin.customer.show') }}?id=${item.customer.id}">${item.customer.name}</a></td>
                                    <td>${totalAmount.toLocaleString('vi-VN')}đ</td>
                                    <td>${item.created_at}</td>
                                    <td>${statusText}</td>
                                    <td>${item.employee ? item.employee.name : "<b>HIỆN CHƯA CÓ</b>"}</td>
                                    <td>
                                        <a href="#" class="btn btn-default" style="cursor: not-allowed;" disabled>Không Được Phép</a>
                                    </td>
                                    <td>
                                        ${item.status == 0 ? '<a href="#" class="btn btn-default" style="cursor: not-allowed;" disabled>Xử Lý Hóa Đơn</a>' : `<a href="{{ route('admin.order.show') }}/?id=${item.id}" class="btn btn-primary">Xử Lý Hóa Đơn</a>`}
                                    </td>
                                </tr>
                            `);
                        }
                    });

                    // Handle pay confirmation button click events
                    $('.pay-confirm-btn').on('click', function(event) {
                        event.preventDefault();
                        const id = $(this).data('id');
                        if (confirm('Bạn có chắc chắn muốn xác nhận thanh toán cho đơn hàng này?')) {
                            confirmPayment(id);
                        }
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
                        toastr.error('Lấy danh sách hóa đơn thất bại!', 'Thất Bại');
                    }
                }
            });

            function confirmPayment(orderId) {
                $.ajax({
                    url: `{{ $api_url }}orders/${orderId}/pay`,
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    },
                    success: function(response) {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-top-right',
                            timeOut: 5000
                        };
                        toastr.success('Xác nhận thanh toán thành công!', 'Thành Công');
                        fetchData(currentPage); // Reload the orders
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            refreshToken().done(function() {
                                confirmPayment(orderId);
                            });
                        } else {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                positionClass: 'toast-top-right',
                                timeOut: 5000
                            };
                            toastr.error('Xác nhận thanh toán thất bại!', 'Thất Bại');
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
                    window.location.href = '{{ route('admin.login') }}'; // Replace with your login route
                });
            }
        }

        $('#search-button').on('click', function(event) {
            event.preventDefault();
            currentSearch = $('#search-input').val();
            if($('#search-input').val() == ""){
                currentSearch = $('#select-input').val();
            }
            currentPage = 1; // Reset to the first page
            fetchData(currentPage, currentSearch);
        });

        // Initial fetch
        fetchData(currentPage, currentSearch);
    });
</script>
@endsection