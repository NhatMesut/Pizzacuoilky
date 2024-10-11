@extends('web.layouts.app')
@section('title', 'Đặt hàng')
@section('title-breadcrumb', 'Đặt hàng')
@section('auth')
<script>
    if (!localStorage.getItem('access_token')) {
        window.location.href  = '{{ route('web.auth') }}';
    }
</script>
@endsection
@section('content')
<section class="checkout-section fix section-padding border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="#" method="post">
                    <div class="row g-4">
                        <div class="col-md-5">
                            <div class="checkout-single-wrapper">
                                <div class="checkout-single boxshado-single">
                                    <h4>Thông Tin Đặt Hàng</h4>
                                    <div class="checkout-single-form">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input type="text" name="address" id="address" required="" placeholder="Địa Chỉ Nhận">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input type="number" name="phone" id="phone" required="" placeholder="Số Điện Thoại">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input type="text" name="coupon" id="coupon" placeholder="Mã Giảm Giá">
                                                </div>
                                            </div>
                                            <div class="mt-4">
                                                <a href="#" class="theme-btn border-radius-none order-now">
                                                Đặt Hàng
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="checkout-radio">
                                <p class="primary-text">Danh sách món</p>
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th style="width: 35%;">Tên Sản Phẩm</th>
                                            <th style="width: 45%;">Thông Tin</th>
                                            <th style="width: 5%;">SL</th>
                                            <th style="width: 15%;">Tạm Tính</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                <ul>
                                    <li>
                                        <span>Tổng Sản Phẩm: </span>
                                        <span class="tsp"></span>
                                    </li>
                                    <li>
                                        <span>Tổng Số Lượng: </span>
                                        <span class="tsl"></span>
                                    </li>
                                    <li>
                                        <span>Tổng Tiền: </span>
                                        <span class="tt"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $(".title-breadcrumb-top").html("ĐẶT HÀNG");

        function fetchData(){
            // Gửi dữ liệu POST đến API
            $.ajax({
                url: '{{ $api_url }}carts',
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    if(response.length == 0){
                        window.location.href = '{{ route('web.product.list') }}';
                    }
                    $('tbody').empty();
                    let sum = 0;
                    let sumProduct = 0;
                    let sumQuantity = 0;
                    response.forEach(item => {
                        let price = Number(item.detail_products.price) * Number(item.quantity) + Number(item.border == null ? 0 : item.border.price) * Number(item.quantity) + Number(item.topping == null ? 0 : item.topping.price) * Number(item.quantity)
                        sum += price;
                        sumProduct++;
                        sumQuantity += item.quantity;
                        $("tbody").append(`
                            <tr class="cart-item">
                                <td class="cart-item-price p-name">
                                    ${item.detail_products.product.name}
                                </td>
                                <td class="cart-item-price">
                                    <ul class="property">
                                        <li class="size-p">Kích thước: ${item.detail_products.size.name} (${Number(item.detail_products.price).toLocaleString('vi-VN')}đ x ${item.quantity})</li>
                                        <li class="border-p">Viền bánh: ${item.border == null ? "Không" : item.border.name} (${Number(item.border == null ? 0 : item.border.price).toLocaleString('vi-VN')}đ x ${item.quantity})</li>
                                        <li class="topping-p">Topping thêm: ${item.topping == null ? "Không" : item.topping.name} (${Number(item.topping == null ? 0 : item.topping.price).toLocaleString('vi-VN')}đ x ${item.quantity})</li>
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
                    $(".tt").html(sum.toLocaleString('vi-VN') + 'đ');
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

        $(".order-now").click(function(e) {
            e.preventDefault();
            var address = $("#address").val();
            var phone = $("#phone").val();
            var coupon = $("#coupon").val();

            var formData = {
                address,
                phone,
                coupon
            };

            function order(){
                $.ajax({
                    url: `{{ $api_url }}orders`,
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    },
                    data: formData,
                    success: function(response) {
                        window.location.href = '{{ route('web.customer.index') }}'
                    },
                    error: function(xhr) {
                        console.log(xhr)
                        if (xhr.status === 401) {
                            
                            refreshToken().done(function() {
                                // Retry the update request with the new token
                                order();
                            });
                        } else {
                            alert('Vui lòng kiểm tra lại thong tin đặt hàng!');
                        }
                    }
                });
            }

            order();
        });

        function profile(){
            $.ajax({
                url: '{{ $api_url }}user/profile',
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $("#phone").val(response.user.customer.phone)
                    $("#address").val(response.user.customer.address)
                },
                error: function(xhr) {
                    if (xhr.status === 401) {
                        refreshToken().done(function() {
                            // Retry the update request with the new token
                            profile();
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
        profile();
    });
</script>
@endsection