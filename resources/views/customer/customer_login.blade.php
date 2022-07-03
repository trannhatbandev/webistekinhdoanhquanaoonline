@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li><a href="#">Tài khoản</a></li>
                <li class="active"><a href="{{url('home/show-login-customer')}}">Đăng nhập</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
@include('customer.alert_customer')
<!-- LogIn Page Start -->
<div class="log-in ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <!-- New Customer Start -->
            <div class="col-md-6">
                <div class="well mb-sm-30">
                    <div class="new-customer">
                        <h3 class="custom-title">Khách hàng mới</h3>
                        <p class="mtb-10"><strong>Đăng ký</strong></p>
                        <p>Bằng cách tạo tài khoản, bạn sẽ có thể mua sắm nhanh hơn, cập nhật trạng thái đơn hàng và theo dõi các đơn hàng bạn đã thực hiện trước đó</p>
                        <a class="customer-btn" href="{{url('home/show-register-customer')}}">Tiếp tục</a>
                    </div>
                </div>
            </div>
            <!-- New Customer End -->
            <!-- Returning Customer Start -->
            <div class="col-md-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10 custom-title">Khách hàng thành viên</h3>
                        <p class="mb-10"><strong>Chào mừng khách hàng đã quay trở lại</strong></p>
                        <form method="post" action="{{url('/home/login-customer')}}">
                            @csrf
                            <div class="form-group">
                                <label>Địa chỉ email</label>
                                <input type="text" name="customer_email" value="{{old('customer_email')}}" id="input-email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" name="customer_password" id="input-password" class="form-control">
                            </div>
                            <p class="lost-password"><a href="{{url('/home/show-forget-password')}}">Quên mật khẩu?</a></p>
                            <input type="submit" value="Đăng nhập" class="return-customer-btn">
                        </form>
                    </div>
                </div>
            </div>
            <!-- Returning Customer End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- LogIn Page End -->
@include('customer.include.footer')
