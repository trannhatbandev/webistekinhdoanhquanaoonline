<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Thêm địa chỉ giao hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <form role="form" method="post" action="{{url('/home/customer/customer-add-address-shipping')}}"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label>Người nhận</label>
                        <input type="text" name="shipping_customer_name" value="{{old('shipping_customer_name')}}" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Số điện thoại</label>
                        <input type="text" name="shipping_customer_phone"  value="{{old('shipping_customer_phone')}}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Địa chỉ</label>
                        <textarea style="resize:none" rows="4" class="form-control" name="shipping_customer_address">{{old('shipping_customer_address')}}</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="info-title control-label">Thành phố <span>*</span></label>
                        <select id="city" name="city" class="form-control select city" >
                            <option>--Lựa chọn--</option>
                            @foreach($city as $key => $value)
                                <option value="{{$value->matp}}">{{$value->nametp}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="info-title control-label"> Quận huyện <span>*</span></label>
                        <select id="district1" name="district" class="form-control district select" >
                            <option>--Lựa chọn--</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label class="info-title control-label">Phường xã <span>*</span></label>
                        <select id="ward1" name="ward" class="form-control ward" >
                            <option>--Lựa chọn--</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary modal-close" type="button" data-dismiss="modal"
                            aria-hidden="true">Hủy
                    </button>
                    <button class="btn btn-primary" type="submit">Thêm</button>
                </div>
            </form>
        </div>
        {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
    </div>
    </div>
</div>
