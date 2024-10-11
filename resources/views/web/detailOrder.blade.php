@extends('web.layouts.app')
@section('title', 'Chi tiết đơn hàng')
@section('title-breadcrumb', 'CHI TIẾT ĐƠN HÀNG')
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
                <div class="col-12">
                    <div class="cart-wrapper">
                        <div class="cart-items-wrapper">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Hình Ảnh</th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Thông Tin</th>
                                        <th>Số Lượng</th>
                                        <th>Tạm Tính</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-xl-6">
                    <div class="cart-pragh-box">
                        <div class="cart-graph">
                            <h4>Tổng Giỏ Hàng</h4>
                            <ul>
                                <li>
                                    <span>Tổng Sản Phẩm</span>
                                    <span class="tsp"></span>
                                </li>
                                <li>
                                    <span>Tổng Số Lượng</span>
                                    <span class="tsl"></span>
                                </li>
                                <li>
                                    <span>Tạm Tính</span>
                                    <span class="ttinh"></span>
                                </li>
                                <li>
                                    <span>Giảm Giá</span>
                                    <span class="gg"></span>
                                </li>
                                <li>
                                    <span>Tổng Tiền</span>
                                    <span class="tt"></span>
                                </li>
                            </ul>
                            <div class="chck">
                                <a href="{{ route('web.customer.index') }}" class="theme-btn border-radius-none">
                                Quay Lại
                                </a>
                                <a href="#" style="background-color: #ff0019;" class="order-status theme-btn border-radius-none d-none">
                                Hủy Đơn
                                </a>
                            </div>
                            <p class="mt-2 text-center error"></p>
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
        $(".title-breadcrumb-top").html("CHI TIẾT ĐƠN HÀNG");

        function fetchData(){
            // Gửi dữ liệu POST đến API
            $.ajax({
                url: '{{ $api_url }}orders/{{ $id }}/detail',
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $('tbody').empty();
                    let sum = 0;
                    let sumProduct = 0;
                    let sumQuantity = 0;
                    response.forEach(item => {
                        let price = Number(item.detail_product.price) * Number(item.quantity) + Number(item.border == null ? 0 : item.border.price) + Number(item.topping == null ? 0 : item.topping.price)
                        sum += price;
                        sumProduct++;
                        sumQuantity += item.quantity;
                        $("tbody").append(`
                            <tr class="cart-item">
                                <td class="cart-item-info p-image">
                                    <img style="width: 129px; height: 132px;" src="{{ asset('storage') }}/${item.detail_product.product.image}" alt="Image">
                                </td>
                                <td class="cart-item-price p-name">
                                    ${item.detail_product.product.name}
                                </td>
                                <td class="cart-item-price">
                                    <ul class="property">
                                        <li class="size-p">Kích thước: ${item.detail_product.size.name} (${Number(item.detail_product.price).toLocaleString('vi-VN')}đ)</li>
                                        <li class="border-p">Viền bánh: ${item.border == null ? "Không" : item.border.name} (${Number(item.border == null ? 0 : item.border.price).toLocaleString('vi-VN')}đ)</li>
                                        <li class="topping-p">Topping thêm: ${item.topping == null ? "Không" : item.topping.name} (${Number(item.topping == null ? 0 : item.topping.price).toLocaleString('vi-VN')}đ)</li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="cart-item-quantity">
                                        ${item.quantity}
                                    </div>
                                </td>
                                <td class="cart-item-price">
                                    <span class="total-price">${price.toLocaleString('vi-VN')}đ</span>
                                </td>
                            </tr>
                        `);
                    });

                    $(".tsp").html(sumProduct + ' loại');
                    $(".tsl").html(sumQuantity + ' cái');
                    $(".ttinh").html(sum.toLocaleString('vi-VN') + 'đ');
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

        function fetchDataOrder(){
            // Gửi dữ liệu POST đến API
            $.ajax({
                url: '{{ $api_url }}orders/{{ $id }}',
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $(".tt").html(Number(response.total_amount).toLocaleString('vi-VN') + 'đ');
                    $(".gg").html(response.coupon == null ? "0%" : response.coupon.value + '%');
                    if ((response.status != 0) && (response.status != 3) && (response.status != 2)) {
                        $(".order-status").removeClass('d-none');
                    } 
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            // Retry the update request with the new token
                            fetchDataOrder();
                        });
                    }
                }
            });
        }

        $('.order-status').on('click', function(e) {
            e.preventDefault();
            // Hiển thị hộp xác nhận
            var confirmation = confirm('Bạn chắc chắn hủy đơn hàng này?');
            if (confirmation) {
                // Nếu người dùng xác nhận, gọi hàm cancel để hủy đơn hàng
                cancel();
            }
        });

        function cancel() {
            // Gửi dữ liệu POST đến API
            $.ajax({
                url: '{{ $api_url }}orders/{{ $id }}/cancel',
                method: 'POST',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $(".order-status").addClass('d-none');
                    $(".error").html("Hủy đơn hàng thành công!");
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            // Retry the update request with the new token
                            cancel();
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
        fetchData();
        fetchDataOrder();
    });
</script>
@endsection