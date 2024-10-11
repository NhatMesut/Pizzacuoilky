@extends('web.layouts.app')
@section('title', 'Giỏ hàng')
@section('title-breadcrumb', 'Giỏ hàng')
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
                                        <th>Xóa</th>
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
                                    <span>Tổng Tiền</span>
                                    <span class="tt"></span>
                                </li>
                            </ul>
                            <div class="chck">
                                <a href="{{ route('web.order') }}" class="theme-btn border-radius-none">
                                Đặt Hàng
                                </a>
                            </div>
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
$(".title-breadcrumb-top").html("GIỎ HÀNG");
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
                $(".cart-pragh-box").css('display', 'none');
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
                        <td class="cart-item-info p-image">
                            <img style="width: 129px; height: 132px;" src="{{ asset('storage') }}/${item.detail_products.product.image}" alt="Image">
                        </td>
                        <td class="cart-item-price p-name">
                            ${item.detail_products.product.name}
                        </td>
                        <td class="cart-item-price">
                            <ul class="property">
                                <li class="size-p">Kích thước: ${item.detail_products.size.name} ${item.detail_products.price.toLocaleString('vi-VN') + 'đ x' + item.quantity} (${Number(item.detail_products.price * item.quantity).toLocaleString('vi-VN')}đ)</li>
                                <li class="border-p">
                                Viền bánh: ${item.border && item.border.name ? item.border.name : "Không"} = ${item.border && item.border.price ? item.border.price.toLocaleString('vi-VN') + 'đ x' + (item.quantity || 0) : ''} (${(item.border && item.border.price ? item.border.price * (item.quantity || 0) : 0).toLocaleString('vi-VN')}đ)
                                 </li>
                                <li class="topping-p">
                                Topping thêm: ${item.topping && item.topping.name ? item.topping.name : "Không"} = ${item.topping && item.topping.price ? item.topping.price.toLocaleString('vi-VN') + 'đ x' + (item.quantity || 0) : ''} (${(item.topping && item.topping.price ? item.topping.price * (item.quantity || 0) : 0).toLocaleString('vi-VN')}đ)
                                </li>

                            </ul>
                        </td>
                        <td>
                            <div class="cart-item-quantity">
                                <input data="${item.id}" type="number" min="1" value="${item.quantity}" class="form-control quantityInput" />
                            </div>
                        </td>
                        <td class="cart-item-price">
                            <span class="total-price">${price.toLocaleString('vi-VN')}đ</span>
                        </td>
                        <td class="cart-item-remove">
                            <a class="cart-item-remove-item" href="#" value="${item.id}">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>
                `);
            });

            $(".tsp").html(sumProduct + ' loại');
            $(".tsl").html(sumQuantity + ' cái');
            $(".tt").html(sum.toLocaleString('vi-VN') + 'đ');

            $(".cart-item-remove-item").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('value');

                function deleteProduct(){
                    $.ajax({
                        url: `{{ $api_url }}carts/${id}`,
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                        },
                        success: function(response) {
                            fetchData();
                        },
                        error: function(xhr) {
                            if (xhr.status === 401) {
                                refreshToken().done(function() {
                                    // Retry the update request with the new token
                                    deleteProduct();
                                });
                            } else {
                                alert('Đã xảy ra lỗi khi thêm giỏ hàng!');
                            }
                        }
                    });
                }

                deleteProduct();
            });

            $(".cart-item-remove-item").click(function(e) {
                e.preventDefault();
                var id = $(this).attr('value');

                function deleteProduct(){
                    $.ajax({
                        url: `{{ $api_url }}carts/${id}`,
                        method: 'DELETE',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                        },
                        success: function(response) {
                            fetchData();
                        },
                        error: function(xhr) {
                            if (xhr.status === 401) {
                                refreshToken().done(function() {
                                    // Retry the update request with the new token
                                    deleteProduct();
                                });
                            }
                        }
                    });
                }

                deleteProduct();
            });

            $('.quantityInput').on('blur', function() {
                // Lấy giá trị của ô input
                var quantity = $(this).val();
                var id = $(this).attr('data');
                // Tạo form data
                var formData = {
                    quantity: quantity
                };

                function updateProduct(){
                    $.ajax({
                        url: `{{ $api_url }}carts/${id}`,
                        method: 'POST',
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                        },
                        data: formData,
                        success: function(response) {
                            fetchData();
                        },
                        error: function(xhr) {
                            if (xhr.status === 401) {
                                refreshToken().done(function() {
                                    // Retry the update request with the new token
                                    updateProduct();
                                });
                            } else {
                                alert('Đã xảy ra lỗi khi cập nhật số lượng giỏ hàng!');
                            }
                        }
                    });
                }

                updateProduct();
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
fetchData();
</script>
@endsection