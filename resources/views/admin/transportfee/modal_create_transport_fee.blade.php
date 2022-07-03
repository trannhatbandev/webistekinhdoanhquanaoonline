<div class="row">
    <div class="full-width modal-container modal-effect-1 colored-header colored-header-primary "
         data-backdrop="static"
         data-keyboard="false" id="nft-fullWidth">
        <div class="modal-content full-width">
            <div class="modal-header modal-header-colored text-center">
                <h3 class="modal-title">Thêm phí vận chuyển</h3>
                <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span
                        class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{url('/admin/transport-fee/add-transport-fee')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                                <label>Chọn tỉnh/thành phố</label>
                                <select class="form-control select city" id="city" name="city">
                                    <option value="0">--- Chọn thành phố ---</option>
                                    @foreach($city as $key => $value)
                                        <option value="{{$value->matp}}">{{$value->nametp}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-group">
                                <label>Chọn quận/huyện</label>
                                <select class="form-control district select" id="district" name="district">
                                    <option value="0">--- Chọn quận, huyện ---</option>
                                    @foreach($district as $key => $value)
                                        <option value="{{$value->maqh}}">{{$value->nameqh}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Chọn xã/phường/thị/trấn</label>
                            <select class="form-control ward" id="ward" name="ward">
                                <option value="0">--- Chọn xã, phường, thị trấn ---</option>
                                @foreach($ward as $key => $value)
                                    <option value="{{$value->maxptt}}">{{$value->namexptt}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Phí vận chuyển</label>
                            <input type="text" name="transport_fee_freeship"  value="{{old('transport_fee_freeship')}}" class="form-control transport_fee_freeship">
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
        </div>

    </div>
</div>



