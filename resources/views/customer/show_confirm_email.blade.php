@include('customer.include.header')

<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="{{url('home/show-register-customer')}}}">Xác nhận email</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
@include('customer.alert_customer')
<div class="register-account ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                @php
                    $token = $_GET['token'];
                    $email = $_GET['email'];
                @endphp
                <form class="form-register" action="{{url('/home/register-success')}}" method="post">
                    @csrf
                    <input type="hidden" name="email" value="{{$email}}"/>
                    <input type="hidden" name="token" value="{{$token}}"/>
                    <div class="form-group">
                        <h1>Xác nhận email thành công</h1>
                    </div>
                    <button type="submit" name="forget-password" class="btn-upper btn btn-primary checkout-page-button">Quay lại trang chủ</button>
                </form>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Register Account End -->
@include('customer.include.footer')
