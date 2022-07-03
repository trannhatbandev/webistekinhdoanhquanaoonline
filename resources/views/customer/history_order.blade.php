@include('customer.include.header')
 <!-- Breadcrumb Start -->
 <div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{url('/')}}">Trang chủ</a></li>
                <li class="active"><a href="#">Lịch sử đơn hàng</a></li>
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
            <div class="col-md-12 col-sm-12 col-xs-12">
                <!-- Form Start -->
                <form action="#">
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-remove">Mã đơn hàng</th>
                                    <th class="product-thumbnail">Tình trạng đơn hàng</th>
                                    <th class="product-name">Hình thức thanh toán</th>
                                    <th class="product-price">Ngày</th>
                                    <th class="product-quantity">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=0;$i<count($orderarr);$i++)
                                    @for($j=0;$j<count($orderarr[$i]);$j++)
                                <tr>
                                    <td class="product-remove">{{$orderarr[$i][$j]->order_code}}</td>
                                    <td class="product-thumbnail">
                                        @if($orderarr[$i][$j]->order_status == 1)
                                        <span class="text text-primary">Đơn hàng mới</span>
                                    @elseif($orderarr[$i][$j]->order_status == 2)
                                        <span class="text text-success">Đã giao hàng</span>
                                    @elseif($$orderarr[$i][$j]->order_status == 3)
                                       <span class="text text-danger">Đã hủy đơn hàng</span>
                                    @endif</td>
                                    <td class="product-name">{{$orderarr[$i][$j]->payment->payment_method}}</td>
                                    <td class="product-price">{{$orderarr[$i][$j]->created_at}}</td>
                                    <td class="product-stock-status">
                                        <a class="md-trigger" href="{{url('/home/order/show-history-order-detail/'.$orderarr[$i][$j]->order_code)}}">
                                        <i class="fas fa-eye" style="color:aqua; font-size:25px"></i></a>
                                        @if($orderarr[$i][$j]->order_status == 1)
                                        <a class="btn btn-danger" href="{{url('/home/order/cancel-order/'.$orderarr[$i][$j]->order_code)}}">Hủy đơn hàng</a>
                                        @endif
                                </tr>

                                    @endfor
                                @endfor
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
