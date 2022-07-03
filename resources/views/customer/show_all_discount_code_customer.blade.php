@include('customer.include.header')
<style>
    *{
        margin: 0;
        padding:0;
    }
    h1{
        color: rgb(17, 255, 0);
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
        background-color: #ac1045;
        color: white;
    }
    #coupon{
        width: 100%;
        height: 200px;
    }
    h3{
        color: rgb(234, 255, 0);
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
<div class="row" style="margin: 10px">
  <div class="col-3">
    <ul class="nav flex-column">
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" style="cursor: pointer;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tài khoản của tôi
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="{{url('/home/customer/change-password-customer')}}"><i class="fas fa-key"></i> Đổi mật khẩu</a>
          <a class="dropdown-item" href="{{url('/home/customer/change-address')}}"><i class="fas fa-address-card" style="color: blue"></i> Địa chỉ</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/home/customer/show-all-discount-code-customer')}}"><i class="fas fa-gift" style="color: orange"></i> Mã khuyến mãi</a>
      </li>
    </ul>
  </div>
    @foreach($discountcode as $value)
        <div class="col-2">
        @include('customer.alert_customer')
            <div class="coupon">
                <div class="coupon-text">
                    <h4>{{$value->discount_code_name}}</h4>
                    @if($value->discount_code_condition==2)
                    <h3>Giảm giá lên đến {{$value->discount_code_price}} % cho khách hàng đã tạo tài khoản trên trang web của chúng tôi</h3>
                    @elseif($value->discount_code_condition==1)
                    <h3>Giảm giá lên đến {{$value->discount_code_price}} đ cho khách hàng đã tạo tài khoản trên trang web của chúng tôi</h3>
                    @endif
                </div>
                <div class="coupon-code">
                    <h4>Mã khuyến mãi: <span id="code">{{$value->discount_code_code}}</span></h4>
                    <p id="date">Bắt đầu: {{$value->discount_code_date_start}} - Kết thúc: {{$value->discount_code_date_end}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@include('customer.include.footer')
