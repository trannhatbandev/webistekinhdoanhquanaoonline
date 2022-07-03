@extends('staff.staff_layout')
@section('staff_content')
    <div class="page-head">
        <h2 class="page-head-title">Chi tiết đơn hàng</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/staff')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">

            @include('staff.alert_staff')
            @php
                $subtotal = 0;
                $total = 0;
                $totalDiscounCode = 0;
                $totalAfter = 0;
            @endphp
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Chi tiết đơn hàng</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableOrderDetail" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Size</th>
                                    <th>Màu sắc</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Số lượng kho</th>
                                    <th>Tổng tiền</th>
                                    <th>Mã khuyến mãi</th>
                                    <th>Phí vận chuyển</th>
                                    <th>Người nhận hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    {{-- <th>Hành động</th> --}}
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
                                            alt=""><span>{{$value->product->product_name}}</span></td>
                                        <td><span>{{$value->size}}</span></td>
                                        <td><span>{{$value->color}}</span></td>
                                        <td><span>{{number_format($value->product->product_price,0,',','.')}}đ</span></td>
                                        <td><input min="1" type="number" style="width: 40px" value="{{$value->product_quantity}}" class="product_quantity_wasehouse_{{$value->product_id}}"
                                            name="product_quantity_wasehouse"/></td>
                                        <td><span>{{$quantity['quantity']}}</span></td>
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
                                <tr>
                                    <td>Cập nhật trạng thái đơn hàng:</td>
                                    <td>
                                        @if($order->order_status ==1)
                                        <form>
                                            @csrf
                                            <select class="order-status">
                                                <option id="{{$order->order_id}}" selected value="1">Đơn hàng mới</option>
                                                <option id="{{$order->order_id}}" value="2">Đã giao hàng</option>
                                                <option id="{{$order->order_id}}" value="3">Đã hủy đơn hàng</option>
                                            </select>
                                        </form>
                                        @elseif($order->order_status ==2)
                                        <form>
                                            @csrf
                                            <select class="order-status">
                                                <option id="{{$order->order_id}}" disabled value="1">Đơn hàng mới</option>
                                                <option id="{{$order->order_id}}" selected value="2">Đã giao hàng</option>
                                                <option id="{{$order->order_id}}" disabled value="3">Đã hủy đơn hàng</option>
                                            </select>
                                        </form>
                                        @elseif($order->order_status ==3)
                                        <form>
                                            @csrf
                                            <select class="order-status">
                                                <option id="{{$order->order_id}}" disabled value="1">Đơn hàng mới</option>
                                                <option id="{{$order->order_id}}" disabled value="2">Đã giao hàng</option>
                                                <option id="{{$order->order_id}}" selected value="3">Đã hủy đơn hàng</option>
                                            </select>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
