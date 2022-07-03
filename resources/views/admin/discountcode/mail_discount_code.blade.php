<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mã khuyến mãi</title>
    <style>
        *{
            margin: 0;
            padding:0;
        }
        body{
            background-color: #ac1045;
            color: white;
        }
        h1{
            color: aqua;
            text-align: center;

        }
        .coupon{
            width: 25%;
            height: auto;
            width: auto;
            background-clip: padding-box;
            border-radius: 15px;
            border: 5px dotted;
            background: #41225e;
        }
        #coupon{
            width: 100%;
            height: 200px;
        }
        h3{
            color: aqua;
            padding: 10px;
        }
        .coupon-text{
            padding: 10px;
        }
        .coupon-code{
            padding: 10px;
            background: #bbb;
            color: black;
        }
        #code{
            background-color: gray;
            padding: 5px;
        }
        #date{
            color: red;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="coupon">
        {{-- <div class="image">
            <img src="{{asset('public/uploads/coupon.jpg')}}" id="coupon">
        </div> --}}

        <div class="coupon-text">
            <h2>{{$dicountCodeArray['discount_code_name']}}</h2>
            @if($dicountCodeArray['discount_code_condition']==2)
            <h3>Giảm giá lên đến <?php echo $dicountCodeArray['discount_code_price']?> % cho khách hàng đã tạo tài khoản trên trang web của chúng tôi</h3>
            @elseif($dicountCodeArray['discount_code_condition']==1)
            <h3>Giảm giá lên đến <?php echo $dicountCodeArray['discount_code_price']?> đ cho khách hàng đã tạo tài khoản trên trang web của chúng tôi</h3>
            @endif
        </div>
        <div class="coupon-code">
            <h3>Mã khuyến mãi: <span id="code">{{$dicountCodeArray['discount_code_code']}}</span></h3>
            <p id="date">Bắt đầu: {{$dicountCodeArray['discount_code_date_start']}} - Kết thúc: {{$dicountCodeArray['discount_code_date_end']}}</p>
        </div>
    </div>
</body>
</html>
