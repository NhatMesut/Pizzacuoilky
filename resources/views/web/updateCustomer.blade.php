@extends('web.layouts.app')
@section('title', 'Cập nhật thông tin')
@section('title-breadcrumb', 'Cập nhật thông tin')
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
                <form class="col-9">
                    <div class="checkout-single-wrapper">
                        <div class="checkout-single boxshado-single">
                            <h4>THÔNG TIN KHÁCH HÀNG</h4>
                            <div class="checkout-single-form">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="input-single">
                                            <input type="text" name="name" class="name" required="" placeholder="Nhập tên">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-single">
                                            <input type="text" name="phone" class="phone" required="" placeholder="Nhập số điện thoại">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-single">
                                            <input type="text" name="address" class="address" required="" placeholder="Nhập địa chỉ nhận hàng">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-lg-12">
                                        <div class="input-single">
                                            <input class="emailRegister email" type="email" name="email" required="" placeholder="Nhập email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-single">
                                            <input class="passwordRegister" type="password" name="password" class="password" placeholder="Nhập mật khẩu">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-single">
                                            <button style="padding: 15px;" class="btn btn-dark w-100 update" type="submit">Cập Nhật</button>
                                        </div>
                                    </div>
                                    <p class="text-center error"></p>
                                </div>
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
        $(".title-breadcrumb-top").html("CẬP NHẬT THÔNG TIN");

        function fetchData(){
            // Gửi dữ liệu POST đến API
            $.ajax({
                url: '{{ $api_url }}user/profile',
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                },
                success: function(response) {
                    $(".name").val(response.user.customer.name);
                    $(".phone").val(response.user.customer.phone);
                    $(".address").val(response.user.customer.address);
                    $(".email").val(response.user.email);

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

        $("form").on('submit', function(e){
            e.preventDefault();

            const formData = $(this).serialize();
            $(".error").html("");
            function update(){
                // Gửi dữ liệu POST đến API
                $.ajax({
                    url: '{{ $api_url }}user/update',
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('access_token')}`
                    },
                    data:formData,
                    success: function(response) {
                        $(".error").html("Cập nhật thông tin thành công!");
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            refreshToken().done(function() {
                                // Retry the update request with the new token
                                update();
                            });
                        }else{
                            $(".error").html("Vui lòng kiểm tra lại thông tin!");
                        }
                    }
                });
            }

            update();
        })

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