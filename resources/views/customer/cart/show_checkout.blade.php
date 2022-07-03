@include('customer.include.header')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="checkout.html">Thanh toán</a></li>
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
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    @include('customer.alert_customer')
                    <a href="{{url('home/show-login-customer')}}"><h3>Khách hàng thành viên? <span id="showlogin">Đăng nhập</span></h3></a>
                    <!-- ACCORDION END -->
                    <!-- ACCORDION START -->
                    <h3>
                        @if(session()->get('customer_id'))
                        <span id="showaddress">
                            {{session()->get('address_shipping')}}</span>
                        <span>
                        @endif
                            Mặc định
                            <div style="display: flex;margin-top:10px">
                                <div class="dropdown" style="margin-right: 10px; ">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                      Thay đổi
                                    </button>
                                    <form>
                                        @csrf
                                        <div class="dropdown-menu">
                                            @foreach($shipping as $value)
                                                <a class="dropdown-item change-address-shipping" data-id="{{$value->shipping_id}}">
                                                    {{$value->shipping_customer_address}}</a>
                                            @endforeach
                                        </div>
                                    </form>
                                  </div>

                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fa fa-plus"> Thêm địa chỉ mới</i></span>
                            </button>

                            </div>
                    </h3>
                    <!-- ACCORDION END -->
                </div>
                @include('customer.cart.modal_address_shipping')
            </div>
        </div>
    </div>
</div>
<!-- coupon-area end -->
<!-- checkout-area start -->
<div class="checkout-area pb-100 pt-15 pb-sm-60">
    <div class="container">
        <div class="row">
            @php
                $subtotal = 0;
                $total = 0;
                $transport_fee_freeship = 0;
                $totaldiscount = 0;
                $totaltransportfreeship=0;
            @endphp
            <div class="col-lg-6 col-md-6">
                <div class="your-order">
                    <h3>Đơn hàng của bạn</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-name">Sản phẩm</th>
                                <th class="product-name">Size</th>
                                <th class="product-name">Màu</th>
                                <th class="product-total">Tổng</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(session()->get('cart') == true)
                                @foreach(session()->get('cart') as $key => $value)
                                    @php
                                        $subtotal = $value['product_price']*$value['product_qty'];
                                        $total+=$subtotal;
                                    @endphp
                                    <tr class="cart_item">
                                        <td class="product-name">
                                            {{$value['product_name']}}<span class="product-quantity">x {{$value['product_qty']}}</span>
                                        </td>
                                        <td>{{$value['size']}}</td>
                                        <td>{{$value['color']}}</td>
                                        <td class="product-total">
                                            <span class="amount">{{number_format($subtotal,0,',','.').'đ'}}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot>
                                @if(session()->get('discount_code'))
                                    @foreach(session()->get('discount_code') as $value)
                                    @if($value['discount_code_condition']==1)
                                                    @php
                                                        $totaldiscount = $total - $value['discount_code_price'];
                                                    @endphp
                                                   <tr>
                                                        <td colspan="3"><span>Mã khuyến mãi:</span></td>
                                                        <td><span class="amount">{{$value['discount_code_code']}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Giảm</td>
                                                        <td><span class="amount">{{number_format($value['discount_code_price'],0,',','.')}} đ</span></td>
                                                    </tr>
                                    @elseif($value['discount_code_condition']==2)
                                                    @php
                                                        $total_down = ($total*$value['discount_code_price'])/100;
                                                        $totaldiscount = $total - $total_down;
                                                    @endphp
                                                    <tr>
                                                        <td colspan="3"><span>Mã khuyến mãi:</span></td>
                                                        <td><span class="amount">{{$value['discount_code_code']}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">Giảm</td>
                                                        <td><span class="amount">{{number_format($value['discount_code_price'],0,',','.')}} %</span></td>
                                                    </tr>
                                                @endif

                                    @endforeach
                                @endif
                                @if(session()->get('transport_fee_freeship'))
                                @php
                                    $transport_fee_freeship= session()->get('transport_fee_freeship');
                                    $totaltransportfreeship = $total + $transport_fee_freeship;
                                @endphp
                                    <tr class="cart-subtotal">
                                        <td colspan="3">Phí vận chuyển</td>
                                        <td><span class="amount">{{number_format($transport_fee_freeship,0,',','.')}} đ</span></td>
                                    </tr>
                                @endif
                                <tr class="order-total">
                                    <td colspan="3"><span class="total amount">Tổng phải thanh toán:</span></td>
                                    <td>
                                        <span class="amount">
                                                 @php
                                                     if(!session()->get('transport_fee_freeship') && session()->get('discount_code')){
                                                         $sum = $totaldiscount;
                                                         echo number_format($sum,0,',','.').'đ';
                                                     }elseif(!session()->get('transport_fee_freeship') && !session()->get('discount_code')){
                                                         $sum = $total;
                                                         echo number_format($sum,0,',','.').'đ';
                                                     }elseif(session()->get('transport_fee_freeship') && !session()->get('discount_code')){
                                                         $sum = $totaltransportfreeship;
                                                         echo number_format($sum,0,',','.').'đ';
                                                     }elseif (session()->get('transport_fee_freeship') && session()->get('discount_code')){
                                                         $sum = $totaldiscount;
                                                         $sum = $sum + session()->get('transport_fee_freeship');
                                                         echo number_format($sum,0,',','.').'đ';
                                                     }
                                                 @endphp
                                            </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="payment-method">
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingtwo" style="display: flex">
                                    <h5 class="mb-0">
                                        <form method="post" action="{{url('/home/momo-checkout')}}">
                                            @csrf
                                            <input type="hidden" name="momo_total" value="{{$sum}}">
                                            <button type="submit" name="payUrl" class="btn btn-link collapsed">
                                                <img style="width: 50px" src="{{asset('public/frontend/img/icon/momo.png')}}">
                                            </button>
                                        </form>
                                    </h5>
                                    <h5 class="mb-0">
                                        <form method="post" action="{{url('/home/offline-checkout')}}">
                                            @csrf
                                            <button type="submit" name="payOffline" class="btn btn-secondary collapsed mt-2">
                                                Thanh toán trực tiếp
                                            </button>
                                        </form>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    <form method="post" action="{{url('/home/discount-code-customer/add-discount-code-customer')}}">
                        @csrf
                        <table class="table">
                            <thead>
                            <tr>
                                <th>
                                    <span class="estimate-title">Mã giảm giá</span>
                                    <p>Vui lòng hãy nhập mã giảm giá(nếu có)</p>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="form-group">
                                        <input type="text" class="form-control unicase-form-control text-input" name="discount_code" placeholder="Mã khuyến mãi của bạn...">
                                    </div>
                                    <div class="clearfix pull-right">
                                        <button type="submit" class="btn-upper btn btn-primary">Áp dụng mã khuyến mãi</button>
                                    </div>
                                    @if(session()->get('discount_code'))
                                        <div class="clearfix pull-right">
                                            <a href="{{url('/home/discount-code-customer/delete-discount-code-customer')}}" style="margin-top: 10px" class="btn-upper btn btn-danger">Xóa mã khuyến mãi</a>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </form>
                </div><!-- /.estimate-ship-tax -->
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@include('customer.include.footer')
