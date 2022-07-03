@extends('admin.admin_layout')
@section('admin_content')
    <div class="page-head">
        <h2 class="page-head-title">Chi tiết đơn hàng</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Chi tiết đơn hàng</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-lg-3">
                    <div class="mt-6 mb-4" style="display: flex">
                        <a href="{{url('/admin/order/export-pdf/'.$order->order_code)}}" class="btn btn-success"><i class="icon mdi mdi-download"> Xuất file PDF</i></a>
                    </div>
            </div>
        </div>
            @include('admin.alert_admin')
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
                                        {{-- <td>
                                            <a class="md-trigger" href="{{url('/admin/order/show-order-detail/'.$value->order_code)}}"><i
                                                    style="color: #0b66bc; font-size: 25px;"
                                                    class="icon mdi mdi-eye"></i></a>
                                            <a href="{{url('/admin/order/delete-order/'.$value->order_code)}}"
                                               onclick="return confirm('Bạn muốn xóa đơn hàng này không?');"><i
                                                    style="color: red ; font-size: 25px;"
                                                    class="icon mdi mdi-delete"></i></a>
                                        </td> --}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
