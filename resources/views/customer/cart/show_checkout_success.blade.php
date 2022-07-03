@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="checkout.html">Thanh toán thành công</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- coupon-area start -->
<div class="coupon-area pt-100 pt-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion text-center">
                    <!-- ACCORDION START -->
                    <h1 style="color:#0b66bc">Thanh toán thành công</h1>
                    <!-- ACCORDION END -->
                    <!-- ACCORDION START -->
                    <a class="btn btn-primary" href="{{url('/')}}">Quay lại trang chủ</a>
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- coupon-area end -->
@include('customer.include.footer')

