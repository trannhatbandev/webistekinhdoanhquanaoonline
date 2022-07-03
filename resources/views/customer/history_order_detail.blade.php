@include('customer.include.header')
 <!-- Breadcrumb Start -->
 <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="#">Chi tiết đơn hàng</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Wish List Start -->
<div class="cart-main-area wish-list ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            @php
                $subtotal = 0;
                $total = 0;
                $totalDiscounCode = 0;
                $totalAfter = 0;
            @endphp
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Form Start -->
                <form action="#">
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Size</th>
                                    <th>Màu sắc</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Mã khuyến mãi</th>
                                    <th>Phí vận chuyển</th>
                                    <th>Người nhận hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orderDetail as $key => $value)
                                    @foreach($quantityWareHouse as $quantity)
                                    @if($value->product_id == $quantity['product_id'] && $value->size == $quantity['size'] && $value->color == $quantity['color'])
                                    @php
                                        $subtotal = $value->product->product_price * $value->product_quantity;
                                        $total += $subtotal;
                                    @endphp
                                    <input type="hidden" value="{{$quantity['quantity']}}" class="quantity_wasehouse_{{$value->product_id}}" name="quantity_wasehouse"/>
                                    <input type="hidden" value="{{$value->product_id}}" name="product_id_wasehouse"/>
                                    <input type="hidden" value="{{$value->size}}" name="size_wasehouse"/>
                                    <input type="hidden" value="{{$value->color}}" name="color_wasehouse"/>
                                    <tr class="quantity_color_{{$value->product_id}}">
                                        <td class="user-avatar cell-detail user-info"><img
                                            src="{{asset('public/uploads/products/'.$value->product->product_image)}}"
                                            style="width: 50px; height:50px"><p>{{$value->product->product_name}}</p></td>
                                        <td><span>{{$value->size}}</span></td>
                                        <td><span>{{$value->color}}</span></td>
                                        <td><span>{{number_format($value->product->product_price,0,',','.')}}đ</span></td>
                                        <td>{{$value->product_quantity}}</td>
                                        <td><span>{{number_format($subtotal,0,',','.')}}đ</span></td>
                                        <td><span>{{$value->discount_code}}</span></td>
                                        <td><span>{{number_format($value->transport_fee,0,',','.')}}đ</span></td>
                                        <td><span>{{$order->shipping->shipping_customer_name}}</span></td>
                                        <td><span>{{$order->shipping->shipping_customer_address}}</span></td>
                                        <td><span>{{$order->shipping->shipping_customer_phone}}</span></td>

                                    </tr>
                                    @endif
                                    @endforeach
                                @endforeach
                                <tr>
                                    <td style="display: flex; margin-top:5px;">
                                        <span style="padding-left: 0px">Tổng:</span>
                                    </td>
                                    <td><span style="padding-left: 5px">{{number_format($total,0,',','.')}}đ</span></td>
                                </tr>
                                    <tr>
                                            @php
                                                if($discountCodeCondition == 2){
                                                    $totalDiscounCode = ($total * $discountCodePrice)/100;
                                                    echo  '<td><span style="padding-left: 0px">Giá khuyến mãi:</span></td><td><span style="padding-left: 5px">'.number_format($totalDiscounCode,0,',','.').'đ</span></td>';
                                                    $totalAfter = $total- $totalDiscounCode;
                                                }else{
                                                    echo  '<td><span>Giá khuyến mãi:</span></td><td><span style="padding-left: 5px">'.number_format($discountCodePrice,0,',','.').'đ</span></td>';
                                                    $totalAfter = $total- $discountCodePrice;
                                                }
                                            @endphp
                                    </tr>

                                <tr>
                                    <td style="display: flex; margin-top:5px;">
                                        <span style="padding-left: 0px">Phí vận chuyển:</span>
                                    </td>
                                    <td>
                                        <span style="padding-left: 5px">{{number_format($transportFee,0,',','.')}}đ</span>
                                        @php
                                                $totalAfter += $transportFee ;
                                        @endphp
                                    </td>
                                </tr>
                                <tr>
                                    <td style="display: flex">
                                        <span style="padding-left: 0px">Thanh toán:</span>
                                    </td>
                                    <td>
                                        <span style="padding-left: 5px">{{number_format($totalAfter,0,',','.')}}đ</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Content Start -->
                </form>
                <!-- Form End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
</div>
<!-- Wish List End -->
@include('customer.include.footer')
