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
        <form method="POST" action="{{url('/home/customer/change-password-customer-update/'.$customer->customer_id)}}">
          @csrf
          <div class="form-group">
            <label>Mật khẩu:</label>
            <input type="password" name="customer_password"  class="form-control">
          </div>
          <div class="form-group">
            <label>Nhập lại mật khẩu:</label>
            <input type="password" name="customer_current_password" class="form-control">
          </div>
        <button type="submit" class="btn btn-danger">Lưu</button>
        </form>
    </div>
</div>

@include('customer.include.footer')
