@include('customer.include.header')
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

  <div class="col-4">
    @include('customer.alert_customer')
        <form method="POST" action="{{url('/home/customer/change-info-customer/'.$customer->customer_id)}}">
          @csrf
          <div class="form-group">
            <label>Họ và tên:</label>
            <input type="text" name="customer_full_name" value="{{$customer->customer_full_name}}" class="form-control">
          </div>
        <div class="form-group">
          <label>Email:</label>
          <div style="display: flex">
            <input type="text" disabled name="customer_email" value="{{$customer->customer_email}}" class="form-control">
          </div>

        </div>
        <div class="form-group">
          <label>Số điện thoại:</label>
          <div style="display: flex">
            <input type="text" name="customer_phone" value="{{$customer->customer_phone}}" class="form-control">
            <a style="cursor:pointer;margin-left: 10px; color:blue">Thay đổi</a>
          </div>
        </div>
        <button type="submit" class="btn btn-danger">Lưu</button>
        </form>
    </div>
</div>

@include('customer.include.footer')
