@extends('web.layouts.app')
@section('title', 'Đăng nhập')
@section('title-breadcrumb', 'Đăng Nhập & Đăng Ký')
@section('auth')
<script>
    if (localStorage.getItem('access_token')) {
        window.location.href  = '{{ route('web.customer.index') }}';
    }
</script>
@endsection
@section('content')
<section class="checkout-section fix section-padding border-bottom">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <div class="row g-4">
                        <form class="col-md-6 login-form">
                            <div class="checkout-single-wrapper">
                                <div class="checkout-single boxshado-single">
                                    <h4>ĐĂNG NHẬP TÀI KHOẢN</h4>
                                    <div class="checkout-single-form">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input class="emailLogin" type="text" name="email" required="" placeholder="Nhập email">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input class="passwordLogin" type="password" name="password" required="" placeholder="Nhập mật khẩu">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <button style="padding: 15px;" class="btn btn-dark w-100" type="submit">Đăng Nhập</button>
                                                </div>
                                            </div>
                                            <p class="text-center errorr"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <form class="col-md-6 register-form">
                            <div class="checkout-single-wrapper">
                                <div class="checkout-single boxshado-single">
                                    <h4>ĐĂNG KÝ TÀI KHOẢN</h4>
                                    <div class="checkout-single-form">
                                        <div class="row g-4">
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input type="text" name="name" required="" placeholder="Nhập tên">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input class="emailRegister" type="email" name="email" required="" placeholder="Nhập email">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input class="passwordRegister" type="password" name="password" required="" placeholder="Nhập mật khẩu">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input type="text" name="phone" required="" placeholder="Nhập số điện thoại">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <input type="text" name="address" required="" placeholder="Nhập địa chỉ nhận hàng">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="input-single">
                                                    <button style="padding: 15px;" class="btn btn-dark w-100" type="submit">Đăng Ký</button>
                                                </div>
                                            </div>
                                            <p class="text-center errorr-register"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        $(".title-breadcrumb-top").html("ĐĂNG NHẬP & ĐĂNG KÝ");
        $('.login-form').on('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách mặc định

            const formData = $(this).serialize();

            $.ajax({
                url: '{{ $api_url . 'login/' }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response.access_token) {
                    localStorage.setItem('access_token', response.access_token);
                    localStorage.setItem('refresh_token', response.refresh_token);
                    window.location.href = '{{ route('web.customer.index') }}';
                    }
                },
                error: function(xhr) {
                    if(xhr.status == 403){
                        $(".errorr").html('Tài khoản hiện bị cấm khỏi hệ thống!');
                    }else{
                        $(".errorr").html('Sai tài khoản hoặc mật khẩu!');
                    }
                }
            });
        });

        $('.register-form').on('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form gửi theo cách mặc định

            const formData = $(this).serialize();

            $.ajax({
                url: '{{ $api_url . 'register/' }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    $(".errorr-register").html('Đăng ký tài khoản thành công vui lòng đăng nhập!');
                    $(".emailLogin").val($(".emailRegister").val());
                    $(".passwordLogin").val($(".passwordRegister").val());
                    $('.register-form')[0].reset();
                },
                error: function(xhr) {
                    $(".errorr-register").html('Sai tài khoản hoặc mật khẩu!');
                }
            });
        });
    });
</script>
@endsection