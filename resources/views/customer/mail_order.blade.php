<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đặt hàng thành công</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="col-lg-6" style="text-align: center;">
        <h4>CÔNG TY CHUYÊN QUẦN ÁO THỜI TRANG TNB</h4>
        <h6>UY TÍN - CHẤT LƯỢNG - GIÁ CẢ PHÙ HỢP</h6>
    </div>
    <div class="col-lg-6">
        <h1>Chào bạn: {{$arrayShipping['shipping_customer_name']}}</h1>
    </div>

    <div class="col-lg-12">
        <h1 style="text-align: center">Bạn có đơn hàng vào ngày hôm nay, thông tin đơn hàng như sau:</h1>
        <h4 style="color:aqua; text-transform:uppercase;">Bạn có đơn hàng vào ngày hôm nay, thông tin đơn hàng như sau:</h4>
        <p>Mã đơn hàng: {{$codeOrder['order_code']}}</p>
        <p>Mã khuyến mãi: {{$codeOrder['discount_code']}}</p>
        <p>Phí vận chuyển: {{$codeOrder['transport_fee']}}đ</p>
        <p>Phương thức thanh toán: {{$payment_method}}</p>
    </div>
        <h4>Thông tin sản phẩm</h4>
        <table class="table table-dark table-hover">
            <thead>
              <tr>
                <th>Sản phẩm</th>
                <th>Giá tiền</th>
                <th>Số lượng đã đặt</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody>
                @php
                $subTotal = 0;
                $total = 0;
                $discountCode = 0;
                $transportFee = 0;
                $totalAfter= 0;
                @endphp
                @foreach($arrayCartOrder as $value)
                    @php
                        $subTotal = $value['product_price']* $value['product_qty'];
                        $total += $subTotal
                    @endphp
              <tr>
                <td>{{$value['product_name']}}</td>
                <td>{{number_format($value['product_price'],0,',','.')}}đ</td>
                <td>{{$value['product_qty']}}</td>
                <td>{{number_format($subTotal,0,',','.')}}đ</td>
              </tr>
              @endforeach
              <tr>
                    <td>Tổng: {{number_format($total,0,',','.')}}đ</td>
              </tr>
              <tr>
                @php
                if($codeOrder['discount_code_condition']==2){
                    $discountCode = ($total * $codeOrder['discount_code_price'])/100;
                    echo  '<td><span style="padding-left: 0px">Giá khuyến mãi:</span></td><td><span style="padding-left: 5px">'.number_format($discountCode,0,',','.').'đ</span></td>';
                    $totalAfter = $total- $discountCode;
                }else{
                    echo  '<td><span>Giá khuyến mãi:</span></td><td><span style="padding-left: 5px">'.number_format($codeOrder['discount_code_price'],0,',','.').'đ</span></td>';
                    $totalAfter = $total- $codeOrder['discount_code_price'];
                }
                @endphp
              </tr>
              <tr>
                <td>
                    <span>Phí vận chuyển:</span>
                </td>
                <td>
                    <span>{{number_format($codeOrder['transport_fee'],0,',','.')}}đ</span>
                    @php
                            $totalAfter += $codeOrder['transport_fee'] ;
                    @endphp
                </td>
            </tr>
            <tr>
                <td>Tổng thanh toán: {{number_format($totalAfter,0,',','.')}}đ</td>
            </tr>
            </tbody>
          </table>
    <div class="row">
        <h1 style="color:brown">Mọi chi tiết xin liên hệ đến sdt: 0978119953 để được chúng tôi liên lạc sớm nhất!</h1>
    </div>

</body>
</html>
