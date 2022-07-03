@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="{{url('home/show-register-customer')}}}">Đăng ký tài khoản</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
    @include('customer.alert_customer')
</div>
<!-- Breadcrumb End -->
<!-- Register Account Start -->
<div class="register-account ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="register-title">
                    <h3 class="mb-10">Đăng ký tài khoản</h3>
                    <p class="mb-10">Nếu bạn đã có tài khoản thì vui lòng đến trang đăng nhập</p>
                </div>
            </div>
        </div>
        <!-- Row End -->
        <div class="row">
            <div class="col-6">
                <p>Đăng nhập bằng tài khoản mạng xã hội</p>
               <a href="{{url('/home/login-facebook')}}"><i class="fab fa-facebook" style="font-size: 50px; color:blue;cursor: pointer;"></i></a>
                <a href="{{url('/home/login-google')}}"><i class="fab fa-google" style="font-size: 50px; color:rgb(255, 47, 0);cursor: pointer;margin-left:10px"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <form class="form-register" action="{{url('/home/register-customer')}}" method="post">
                    @csrf
                    <fieldset>
                        <legend>Thông tin tài khoản của bạn</legend>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="f-name"><span class="require">*</span>Địa chỉ email</label>
                            <div class="col-md-10">
                                <input type="text" name="customer_email" value="{{old('customer_email')}}" class="form-control" id="f-name">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="l-name"><span class="require">*</span>Họ và tên</label>
                            <div class="col-md-10">
                                <input type="text" name="customer_full_name" value="{{old('customer_full_name')}}" class="form-control" id="l-name">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="email"><span class="require">*</span>Số điện thoại</label>
                            <div class="col-md-10">
                                <input type="text" name="customer_phone" value="{{old('customer_phone')}}" class="form-control" id="email">
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Địa chỉ của bạn</legend>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="number"><span class="require">*</span>Địa chỉ</label>
                            <div class="col-md-10">
                                <input type="text" placeholder="Nhập thôn/đường/xóm" name="customer_address" value="{{old('customer_address')}}" class="form-control" id="number" >
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                                            <div class="form-group col-md-4">
                                                <label class="info-title control-label">Thành phố <span>*</span></label>
                                                <select id="city" name="city" class="form-control select city" >
                                                    <option>--Lựa chọn thành phố--</option>
                                                    @foreach($city as $key => $value)
                                                        <option value="{{$value->matp}}">{{$value->nametp}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="info-title control-label"> Quận huyện <span>*</span></label>
                                                <select id="district1" name="district" class="form-control district select" >
                                                    <option>--Lựa chọn quận huyện--</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="info-title control-label">Phường xã thị trấn <span>*</span></label>
                                                <select id="ward1" name="ward" class="form-control ward" >
                                                    <option>--Lựa chọn phường xã thị trấn--</option>
                                                </select>
                                            </div>
                    </fieldset>
                    <fieldset>
                        <legend>Mật khẩu của bạn</legend>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="pwd"><span class="require">*</span>Mật khẩu:</label>
                            <div class="col-md-10">
                                <input type="password" name="customer_password" value="{{old('customer_password')}}" class="form-control" id="pwd">
                            </div>
                        </div>
                        <div class="form-group d-md-flex align-items-md-center">
                            <label class="control-label col-md-2" for="pwd-confirm"><span class="require">*</span>Nhập lại mật khẩu</label>
                            <div class="col-md-10">
                                <input type="password" name="customer_current_password" value="{{old('customer_current_password')}}" class="form-control" id="pwd-confirm">
                            </div>
                        </div>
                    </fieldset>
                    <div class="terms">
                        <div class="float-md-right">
                            <input type="submit" value="Đăng ký" class="return-customer-btn">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Register Account End -->
@include('customer.include.footer')
