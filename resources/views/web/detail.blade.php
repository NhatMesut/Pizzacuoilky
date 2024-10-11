@extends('web.layouts.app')
@section('title-breadcrumb', 'Danh sách Pizza')
@section('content')
<style>
    .image{
        text-align: center;
    }
</style>
<section class="product-details-section section-padding">
    <div class="container">
        <div class="product-details-wrapper style-2">
            <div class="row g-4">
                <div class="col-xl-4 col-lg-6">
                    <div class="product-image-items">
                        <div class="product-image">
                            <img style="width: 414px; height: 370px;" class="image_origin" src="" alt="img" class="w-100">
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-content">
                        <div class="star pb-3">
                            <a href="#"> <i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"> <i class="fas fa-star"></i></a>
                            <a href="#"><i class="fas fa-star"></i></a>
                            <a href="#"> <i class="fas fa-star"></i></a>
                        </div>
                        <h3 class="pb-3 p-name"></h3>
                        <div class="price-list d-flex align-items-center mb-4">
                            <del class="price" style="text-decoration: none;"></del>
                        </div>
                        <p class="mb-4 sort_des">
                        </p>
                        <div class="social-icon d-flex align-items-center">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-vimeo-v"></i></a>
                            <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="product-form-wrapper">
                        <form action="#" id="contact-forms" method="POST">
                            <div class="form-clt">
                                <label class="select-crust">Chọn Kích Thước</label>
                                <div class="nice-select" tabindex="0">
                                    <span class="current">
                                        Chọn Kích Thước
                                    </span>
                                    <ul class="list size-list" style="min-width: fit-content;">

                                    </ul>
                                </div>
                            </div>
                            <div class="form-clt">
                                <label class="select-crust">Chọn Viền Bánh</label>
                                <div class="nice-select" tabindex="0">
                                    <span class="current">
                                        Chọn Viền Bánh
                                    </span>
                                    <ul class="list border-list" style="min-width: fit-content;">

                                    </ul>
                                </div>
                            </div>
                            <div class="form-clt">
                                <label class="select-crust">Chọn Topping</label>
                                <div class="nice-select" tabindex="0">
                                    <span class="current">
                                        Chọn Topping
                                    </span>
                                    <ul class="list topping-list" style="min-width: fit-content;">

                                    </ul>
                                </div>
                            </div>
                            <div class="form-clt">
                                <label class="select-crust">Số Lượng</label>
                                <div class="quantity-basket">
                                    <p class="qty">
                                        <button class="qtyminus" aria-hidden="true">&minus;</button>
                                        <input type="number" name="qty" id="qty2" min="1" max="10" step="1" value="1">
                                        <button class="qtyplus" aria-hidden="true">&plus;</button>
                                    </p>
                                </div>
                            </div>
                            <div class="form-clt">
                                <button type="submit" class="theme-btn">
                                    <i class="far fa-shopping-bag"></i>
                                    <span class="button-text add-to-cart">Thêm Giỏ Hàng</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="single-tab">
                <ul class="nav mb-4">
                    <li class="nav-item">
                        <a href="#description" data-bs-toggle="tab" class="nav-link active">
                        Mô Tả Chi Tiết Bánh
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#additional" data-bs-toggle="tab" class="nav-link">
                        Thông Tin Thêm
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div id="description" class="tab-pane fade show active">
                        <div class="description-items">

                        </div>
                    </div>
                    <div id="additional" class="tab-pane fade">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Viền Bánh</td>
                                        <td>
                                            <ul class="border-product">

                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kích Thước</td>
                                        <td>
                                            <ul class="size-product">

                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Topping Bánh</td>
                                        <td>
                                            <ul class="topping-product">

                                            </ul>
                                        </td>
                                    </tr>
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
        var slug = "{{ $slug }}";
        const id = slug.match(/(\d+)\.html$/)[1];
        var price = 0;
        var priceDisplay = 0;
        var borderPrice = 0;
        var toppingPrice = 0;
        var qtyValue = 1;
        function fetchData(page, search = '') {
            $.ajax({
                url: `{{ $api_url }}products/${id}`,
                method: 'GET',
                success: function(response) {
                    let priceMax = 0;
                    $(".p-name").text(response.name);
                    $(".description-items").html(response.detailed_description);
                    $(".sort_des").html(response.short_description);
                    $('.image_origin').attr("src", `{{ asset('storage') }}/${response.image}`);
                    $(".title-breadcrumb-top").html(response.name);
                    $("title").html(response.name)
                    if(response.detail_products.length == 1){
                        price = Number(response.detail_products[0].price);
                        $(".price").text(price.toLocaleString('vi-VN') + "đ");
                    }else if(response.detail_products.length > 1){
                        price = Number(response.detail_products[0].price);
                        priceMax = Number(response.detail_products[response.detail_products.length - 1].price);
                        $(".price").text(price.toLocaleString('vi-VN') + "đ đến " + priceMax.toLocaleString('vi-VN') + "đ");
                    }else{
                        $(".price").text("0đ");
                    }
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        function fetchDataBorder() {
            $.ajax({
                url: `{{ $api_url }}products/${id}/border`,
                method: 'GET',
                success: function(response) {
                    response.forEach(item => {
                        $(".border-product").append(`<li>${item.border.name}</li>`);
                        $(".border-list").append(`
                            <li data-value="${item.border.id}" value="${item.border.price}" class="option">
                                ${item.border.name} (+ ${Number(item.border.price).toLocaleString('vi-VN')}Đ)
                            </li>
                        `);
                    });

                    $('.border-list .option').on('click', function() {
                        borderPrice = Number($(this).attr('value'));
                        $(".price").text(((priceDisplay + toppingPrice + borderPrice) * qtyValue).toLocaleString('vi-VN') + "đ");
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        function fetchDataSize() {
            $.ajax({
                url: `{{ $api_url }}products/${id}/detail`,
                method: 'GET',
                success: function(response) {
                    response.forEach(item => {
                        $(".size-product").append(`<li>${item.size.name}</li>`);
                        $(".size-list").append(`
                            <li data-value="${item.id}" value="${item.price}" class="option">
                                ${item.size.name} (${Number(item.price).toLocaleString('vi-VN')}Đ)
                            </li>
                        `);
                    });

                    $('.size-list .option').on('click', function() {
                        var value = Number($(this).attr('value'));
                        priceDisplay = value;
                        $(".price").text(Number((priceDisplay + toppingPrice + borderPrice) * qtyValue).toLocaleString('vi-VN') + "đ");
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        function fetchDataTopping() {
            $.ajax({
                url: `{{ $api_url }}products/${id}/topping`,
                method: 'GET',
                success: function(response) {
                    response.forEach(item => {
                        $(".topping-product").append(`<li>${item.topping.name}</li>`);
                        $(".topping-list").append(`
                            <li data-value="${item.topping.id}" value="${item.topping.price}" class="option">
                                ${item.topping.name} (+ ${Number(item.topping.price).toLocaleString('vi-VN')}Đ)
                            </li>
                        `);
                    });

                    $('.topping-list .option').on('click', function() {
                        toppingPrice = Number($(this).attr('value'));
                        $(".price").text(((priceDisplay + toppingPrice + borderPrice) * qtyValue).toLocaleString('vi-VN') + "đ");
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }



        $('.add-to-cart').on('click', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách mặc định

            // Lấy dữ liệu từ các dropdown và input
            var size = $('.size-list .selected').data('value');
            var border = $('.border-list .selected').data('value');
            var topping = $('.topping-list .selected').data('value');
            var quantity = $('#qty2').val();

            // Tạo form data
            var formData = {
                detail_product_id: size,
                border_id: border,
                topping_id: topping,
                quantity: quantity
            };

            function addToCart(){
                // Gửi dữ liệu POST đến API
                $.ajax({
                    url: '{{ $api_url }}carts',
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    },
                    data: formData,
                    success: function(response) {
                        alert('Thêm giỏ hàng thành công!');
                        // Xử lý thành công (có thể cập nhật giỏ hàng, hiển thị thông báo, v.v.)
                    },
                    error: function(xhr) {
                        console.log(xhr)
                        if (xhr.status === 401) {
                            refreshToken().done(function() {
                                // Retry the update request with the new token
                                addToCart();
                            });
                        } else {
                            alert('Không thể thêm sản phẩm vào giỏ hàng!');
                        }
                    }
                });
            }

            addToCart();
        });

        $('input[name="qty"]').on('input change', function() {
            qtyValue = Number($(this).val());
            $(".price").text(((priceDisplay + toppingPrice + borderPrice) * qtyValue).toLocaleString('vi-VN') + "đ");
        });

        $('.qtyminus').on('click', function() {
            var qtyInput = $(this).siblings('input[name="qty"]');
            var currentValue = parseInt(qtyInput.val());
            if (currentValue >= 1) {
                qtyInput.val(currentValue).trigger('change');
            }
        });

        // Bắt sự kiện click của nút tăng
        $('.qtyplus').on('click', function() {
            var qtyInput = $(this).siblings('input[name="qty"]');
            var currentValue = parseInt(qtyInput.val());
            qtyInput.val(currentValue).trigger('change');
        });

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
        fetchDataBorder();
        fetchDataSize();
        fetchDataTopping();
    });
</script>
@endsection