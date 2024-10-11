@extends('web.layouts.app')
@section('title', 'Danh sách Pizza')
@section('title-breadcrumb', 'Danh sách Pizza')
@section('content')
<section class="food-category-section fix section-padding">
    <div class="container">
        <div class="row g-4">
            <div class="col-xl-3 col-lg-4 order-2 order-md-1 mt-5">
                <div class="main-sidebar">
                    <div class="single-sidebar-widget">
                        <div class="wid-title">
                            <h4>Chuyên Mục</h4>
                        </div>
                        <div class="widget-categories">
                            <ul class="list-categories">
                            </ul>
                        </div>
                    </div>
                    <div class="single-sidebar-widget">
                        <div class="wid-title">
                            <h4>LỌC THEO GIÁ</h4>
                        </div>
                        <div class="range__barcustom">
                            <div class="slider">
                                <div class="progress" style="left: 25%; right: 25%;"></div>
                            </div>
                            <div class="range-input">
                                <input type="range" class="range-min" min="0" max="150000" value="50000">
                                <input type="range" class="range-max" min="100" max="150000" value="75000">
                            </div>
                            <div class="range-items">
                                <div class="price-input d-flex">
                                    <div class="field">
                                        <span>Giá:</span>
                                    </div>
                                    <div class="field">
                                        <input type="number" class="input-min" value="0">
                                    </div>
                                    <div class="separators">-</div>
                                    <div class="field">
                                        <input type="number" class="input-max" value="0">
                                    </div>
                                    <a href="shop-left-sidebar.html" class="theme-btn border-radius-none">LỌC</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="single-sidebar-widget">
                        <div class="wid-title">
                            <h4>Lọc Kích Thước</h4>
                        </div>
                        <div class="filter-size">
                            
                            
                        </div>
                    </div>
                    <div class="single-sidebar-widget">
                        <div class="wid-title">
                            <h4>Pizza Nóng Hổi</h4>
                        </div>
                        <div class="popular-food-posts">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-8 order-1 order-md-2">
                <div class="woocommerce-notices-wrapper" style="padding: 15px 20px;">
                    <div class="product-showing">
                        <h5><a href="#" class="title-sub"><span><img src="https://modinatheme.com/html/foodking-html/assets/img/filter.png" alt="img"></span> Danh Sách Pizza</a></h5>
                    </div>
                    <div class="form-clt">
                        <div class="icon">
                            <a href="#"><i class="fas fa-th"></i></a>
                        </div>
                        <div class="icon-2">
                            <a href="#"><i class="fas fa-list"></i></a>
                        </div>
                    </div>
                </div>
                <div class="row list-pizza">
                
                </div>
                <div class="page-nav-wrap mt-5 text-center">
                    <ul class="pagination" style="justify-content: center;">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).ready(function() {

        var slugCategory = '{{ $slug ?? "" }}';

        var currentPage = 1;

        var currentSearch = '';

        if(slugCategory != ""){
            currentSearch = slugCategory;
        }

        function fetchDataCategory(page, search = '') {
            $.ajax({
                url: `{{ $api_url }}categories?page=${page}&search=${search}`,
                method: 'GET',
                success: function(response) {
                    // Populate the table with data
                    response.data.forEach(item => {
                        const url = `/loai-pizza/${encodeURIComponent(item.slug)}`;
                        $('.list-categories').append(`
                            <li>
                                <a href="${url}">
                                    <img style="width: 25px; height: 25px;" src="{{ asset('storage') }}/${item.image}" alt="${item.name}" alt="img"> 
                                    ${item.name}
                                </a>
                            </li>
                        `);
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        function fetchDataPizza(page, search = '') {
            let totalPages = 0;
            $.ajax({
                url: `{{ $api_url }}products?page=${page}&search=${search}`,
                method: 'GET',
                success: function(response) {
                    // Clear the table body
                    $('.list-pizza').empty();
                    // Populate the table with data
                    response.data.forEach(item => {
                        if(slugCategory != ""){
                            $(".title-breadcrumb-top").html(item.category.name);
                            $(".title-sub").html(`<span><img src="https://modinatheme.com/html/foodking-html/assets/img/filter.png" alt="img"></span> Loại Bánh: ${item.category.name}`);
                        }else{
                            $(".title-breadcrumb-top").html("DANH SÁCH PIZZA");
                            $(".title-sub").html(`<span><img src="https://modinatheme.com/html/foodking-html/assets/img/filter.png" alt="img"></span> DANH SÁCH PIZZA`);
                        }
                        
                        let price = 0;

                        if(item.detail_products.length != 0){
                            price = Number(item.detail_products[0].price);
                        }
                        const url = `/pizza/${encodeURIComponent(item.slug)}-${item.id}.html`;
                        $('.list-pizza').append(`
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <a href="#">
                                    <div class="catagory-product-card-2 shadow-style text-center">
                                        <div class="catagory-product-image">
                                            <img style="width: 209px; height: 208px;" src="{{ asset('storage') }}/${item.image}" alt="${item.name}" alt="product-img">
                                        </div>
                                        <div class="catagory-product-content">
                                            <div class="info-price d-flex align-items-center justify-content-center">
                                                <span>Giá: ${price.toLocaleString('vi-VN')}đ</span>
                                            </div>
                                            <h4>
                                                <a href="${url}">${item.name}</a>
                                            </h4>
                                            <div class="star">
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `);

                        // Clear pagination
                        $('.pagination').empty();

                        // Generate pagination links
                        response.links.forEach(link => {
                            if (link.url) {
                                $('.pagination').append(`
                                    <li><a class="page-numbers" href="#" data-url="${link.url}">${link.label}</a></li>
                                `);
                            }
                        });

                        // Handle pagination click events
                        $('.page-numbers').on('click', function(event) {
                            event.preventDefault();
                            const url = $(this).data('url');
                            const page = new URL(url).searchParams.get('page');
                            fetchDataPizza(page, currentSearch);
                        });

                        let pizzaHotCount = 1;
                        $.ajax({
                            url: `{{ $api_url }}products?page=${response.last_page}`,
                            method: 'GET',
                            success: function(response) {
                                // Clear the table body
                                $('.popular-food-posts').empty();
                                // Populate the table with data
                                response.data.forEach(item => {
                                    let price = 0;

                                    if(item.detail_products.length != 0){
                                        price = Number(item.detail_products[0].price);
                                    }

                                    if(pizzaHotCount <= 5){
                                        const url = `/pizza/${encodeURIComponent(item.slug)}-${item.id}.html`;
                                        $('.popular-food-posts').append(`
                                            <div class="single-post-item">
                                                <div class="thumb bg-cover" style="background-image: url('{{ asset('storage') }}/${item.image}');"></div>
                                                <div class="post-content">
                                                    <div class="star">
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                        <span class="fas fa-star"></span>
                                                    </div>
                                                    <h4><a href="${url}">${item.name}</a></h4>
                                                    <div class="post-price">
                                                        <span>Giá:</span>
                                                        <span class="theme-color-2">${price.toLocaleString('vi-VN')}đ</span>
                                                    </div>
                                                </div>
                                            </div>
                                        `);
                                    }
                                    pizzaHotCount++
                                    
                                });
                            },
                            error: function(xhr) {
                                console.log(xhr)
                            }
                        });


                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        function fetchDataSize(page = 1, search = '') {
            $.ajax({
                url: `{{ $api_url }}sizes?page=${page}&search=${search}`,
                method: 'GET',
                success: function(response) {
                    // Populate the table with data
                    response.data.forEach(item => {
                        $('.filter-size').append(`
                            <div class="input-save d-flex align-items-center">
                                <input type="checkbox" class="form-check-input" value="${item.id}" name="size_id" id="size-${item.id}">
                                <label for="size-${item.id}">${item.name}</label>
                            </div>
                        `);
                    });
                },
                error: function(xhr) {
                    console.log(xhr)
                }
            });
        }

        function fetchProductsBySize(page) {
            // Lấy tất cả các kích thước đã chọn
            const selectedSizes = $('input[name="size_id"]:checked').map(function() {
                return $(this).val();
            }).get();

            // Tạo chuỗi tìm kiếm từ các kích thước đã chọn
            const search = selectedSizes.join(',');

            $.ajax({
                url: `{{ $api_url }}products?page=${page}&search=${search}`,
                method: 'GET',
                success: function(response) {
                    // Clear the table body
                    $('.list-pizza').empty();
                    // Populate the table with data
                    response.data.forEach(item => {
                        let price = 0;

                        if(item.detail_products.length != 0){
                            price = Number(item.detail_products[0].price);
                        }
                        const url = `/pizza/${encodeURIComponent(item.slug)}-${item.id}.html`;
                        $('.list-pizza').append(`
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <a href="#">
                                    <div class="catagory-product-card-2 shadow-style text-center">
                                        <div class="catagory-product-image">
                                            <img style="width: 209px; height: 208px;" src="{{ asset('storage') }}/${item.image}" alt="${item.name}" alt="product-img">
                                        </div>
                                        <div class="catagory-product-content">
                                            <div class="info-price d-flex align-items-center justify-content-center">
                                                <span>Giá: ${price.toLocaleString('vi-VN')}đ</span>
                                            </div>
                                            <h4>
                                                <a href="${url}">${item.name}</a>
                                            </h4>
                                            <div class="star">
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                                <span class="fas fa-star"></span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `);

                        // Clear pagination
                        $('.pagination').empty();

                        // Generate pagination links
                        response.links.forEach(link => {
                            if (link.url) {
                                $('.pagination').append(`
                                    <li><a class="page-numbers" href="#" data-url="${link.url}">${link.label}</a></li>
                                `);
                            }
                        });

                        // Handle pagination click events
                        $('.page-numbers').on('click', function(event) {
                            event.preventDefault();
                            const url = $(this).data('url');
                            const page = new URL(url).searchParams.get('page');
                            fetchDataPizza(page, currentSearch);
                        });
                    })
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }

        // Theo dõi sự kiện thay đổi của các checkbox
        $('.filter-size').on('change', 'input[name="size_id"]', function() {
            fetchProductsBySize(currentPage);
        });

        fetchDataCategory(currentPage);
        fetchDataPizza(currentPage, currentSearch);
        fetchDataSize();
    });
</script>
@endsection