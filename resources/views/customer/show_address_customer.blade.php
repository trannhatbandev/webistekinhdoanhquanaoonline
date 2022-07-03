@include('customer.include.header')
<div class="row" style="margin: 10px">
  <div class="col-3">
    <ul class="nav flex-column navbar-light" style="background-color: #e3f2fd;">
      <li class="nav-item dropdown active">
        <a class="nav-link dropdown-toggle" style="cursor: pointer;" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-edit"></i> Tài khoản của tôi
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
        <form method="POST" action="{{url('/home/customer/change-address-update/'.$customer->customer_id)}}">
          @csrf
          <fieldset>
          <div class="form-group">
            <label>Địa chỉ:</label>
            <input type="text" disabled name="customer_address_old" value="{{$customer->customer_address}}" class="form-control">
          </div>
        </fieldset>
          <fieldset>
            <legend>Thay đổi địa chỉ</legend>
            <div class="form-group">
                <label>Nhập tên đường/thôn/xóm:</label>
                <input type="text" name="customer_address" class="form-control">
              </div>
          <div class="form-group">
            <label class="info-title control-label">Thành phố <span>*</span></label>
            <select id="city" name="city" class="form-control select city" >
                <option>--Lựa chọn--</option>
                @foreach($city as $key => $value)
                    <option value="{{$value->matp}}">{{$value->nametp}}</option>
                @endforeach
            </select>
        </div>
            <div class="form-group">
                <label class="info-title control-label"> Quận huyện <span>*</span></label>
                <select id="district1" name="district" class="form-control district select" >
                    <option>--Lựa chọn--</option>
                </select>
            </div>
            <div class="form-group">
                <label class="info-title control-label">Phường xã <span>*</span></label>
                <select id="ward1" name="ward" class="form-control ward" >
                    <option>--Lựa chọn--</option>
                </select>
            </div>
        <button type="submit" class="btn btn-danger">Lưu</button>
        </fieldset>
        </form>
    </div>
</div>

@include('customer.include.footer')
