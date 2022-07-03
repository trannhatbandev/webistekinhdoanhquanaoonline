@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li><a href="#">Tài khoản</a></li>
                <li class="active"><a href="{{url('/home/show-forget-password')}}">Quên mật khẩu</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
@include('customer.alert_customer')
<!-- Register Account Start -->
<div class="Lost-pass ptb-100 ptb-sm-60">
    <div class="container">
        <div class="register-title">
            <h3 class="mb-10 custom-title">Đăng ký tài khoản</h3>
            <p class="mb-10">Nếu bạn đã có tài khoản vui lòng đăng nhập</p>
        </div>
        <form class="password-forgot clearfix" method="post" action="{{url('/home/recover-password')}}">
            @csrf
            <fieldset>
                <legend>Thông tin chi tiết</legend>
                <div class="form-group d-md-flex">
                    <label class="control-label col-md-2" for="email"><span class="require">*</span>Nhập địa chỉ email</label>
                    <div class="col-md-10">
                        <input type="text" name="customer_email" value="{{old('customer_email')}}" class="form-control" id="email">
                    </div>
                </div>
            </fieldset>
            <div class="buttons newsletter-input">
                <div class="float-left float-sm-left">
                    <a class="customer-btn mr-20" href="{{url('home/show-login-customer')}}">Trở lại</a>
                </div>
                <div class="float-right float-sm-right">
                    <input type="submit" value="Tiếp tục" class="return-customer-btn">
                </div>
            </div>
        </form>
    </div>
    <!-- Container End -->
</div>
<!-- Register Account End -->
@include('customer.include.footer')
