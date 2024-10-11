@extends('web.layouts.app')
@section('title', 'Đơn Hàng')
@section('title-breadcrumb', 'Đơn Hàng')
@section('auth')
<script>
    if (!localStorage.getItem('access_token')) {
        window.location.href  = '{{ route('web.auth') }}';
    }
</script>
@endsection
@section('content')
<section class="cart-section section-padding fix">
    <div class="container">
        <div class="main-cart-wrapper">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-3">
                    <div class="checkout-radio">
                        <p class="primary-text">CHỨC NĂNG</p>
                        <div class="checkout-radio-wrapper">
                            <div class="checkout-radio-single">
                                <a href="{{ route('web.customer.index') }}"><i class="fas fa-list-alt"></i> DANH SÁCH ĐƠN HÀNG</a>
                            </div>
                            <hr>
                            <div class="checkout-radio-single">
                                <a href="{{ route('web.cart') }}"><i class="fas fa-shopping-cart"></i> GIỎ HÀNG</a>
                            </div>
                            <hr>
                            <div class="checkout-radio-single">
                                <a href="{{ route('web.customer.update') }}"><i class="fas fa-edit"></i> CẬP NHẬT THÔNG TIN</a>
                            </div>
                            <hr>
                            <div class="checkout-radio-single">
                                <a href="#" class="logout"><i class="fas fa-sign-out-alt"></i> ĐĂNG XUẤT</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
                    <div class="cart-wrapper">
                        <div class="cart-items-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Mã Đơn Hàng</th>
                                        <th>Tổng Tiền</th>
                                        <th>Ngày Đặt</th>
                                        <th>Trạng Thái</th>
                                        <th>Xem Đơn</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(".title-breadcrumb-top").html("ĐƠN HÀNG");

        function fetchData(){
            // Gửi dữ liệu POST đến API
            $.ajax({
                url: '{{ $api_url }}orders',
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $('tbody').empty();
                    response.data.forEach(item => {
                        let price = Number(item.total_amount);
                        var statusText;
                        if (item.status === 1) {
                            statusText = "Chờ Duyệt Đơn";
                        } else if (item.status === 2) {
                            statusText = "Đang Chế Biến";
                        } else if (item.status === 3) {
                            statusText = "Hoàn Tất";
                        } else {
                            statusText = "Đã Huỷ"; 
                        }
                        $("tbody").append(`
                            <tr class="cart-item">
                                <td class="cart-item-price p-name">
                                    ${item.order_code}
                                </td>
                                <td class="cart-item-price">
                                    <span class="total-price">${price.toLocaleString('vi-VN')}đ</span>
                                </td>
                                <td class="cart-item-price">
                                    ${item.created_at}
                                </td>
                                <td class="cart-item-price">
                                    ${statusText}
                                </td>
                                <td class="cart-item-remove">
                                    <a class="cart-item-remove-item" href="/don-hang/${item.id}">
                                        XEM CHI TIẾT
                                    </a>
                                </td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            // Retry the update request with the new token
                            fetchData();
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
                window.location.href = '/tai-khoan'; // Replace with your login route
            });
        }

        $(".logout").click(function(e){
            e.preventDefault();
            localStorage.removeItem('access_token');
            localStorage.removeItem('refresh_token');
            window.location.href = '{{ route('web.auth') }}';
        });

        fetchData();
    });
</script>
@endsection