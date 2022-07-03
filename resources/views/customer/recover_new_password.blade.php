@include('customer.include.header')

<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li><a href="#">Tài khoản</a></li>
                <li class="active"><a href="#">Lấy lại mật khẩu</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
@include('customer.alert_customer')
<div class="body-content">
    <div class="container">
        <div class="sign-in-page">
            <div class="row">
                <!-- create a new account -->
                <div class="col-md-6 col-sm-6 create-new-account">
                    @php
                        $token = $_GET['token'];
                        $email = $_GET['email'];
                    @endphp
                    <form class="register-form outer-top-xs"  method="post" action="{{url('/home/recover-new-password')}}">
                        @csrf
                        <input type="hidden" name="email" value="{{$email}}"/>
                        <input type="hidden" name="token" value="{{$token}}"/>
                        <div class="form-group">
                            <label class="info-title"  for="exampleInputEmail1">Nhập mật khẩu mới<span>*</span></label>
                            <input type="password" name="customer_password" value="{{old('customer_password')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                        </div>
                        <div class="form-group">
                            <label class="info-title"  for="exampleInputEmail1">Nhập lại mật khẩu <span>*</span></label>
                            <input type="password" name="customer_current_password" value="{{old('customer_current_password')}}" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                        </div>
                        <button type="submit" name="recover_new_password" class="btn-upper btn btn-primary checkout-page-button">Gửi</button>
                    </form>
                </div>
                <!-- create a new account -->			</div><!-- /.row -->
        </div><!-- /.sigin-in-->
    </div><!-- /.container -->
</div><!-- /.body-content -->
@include('customer.include.footer')
