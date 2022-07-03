<div class="row">
    <form action="{{url('/admin/discount-code/update-discount-code/'.$value->discount_code_id)}}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left colored-header colored-header-primary" id="update-modal{{$value->discount_code_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cập nhật mã khuyến mãi</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Tên khuyến mãi</label>
                                <input type="text" name="discount_code_name" value="{{$value->discount_code_name}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Mã khuyến mãi</label>
                                <input type="text" name="discount_code_code"  value="{{$value->discount_code_code}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Số lượng mã</label>
                                <input type="text" name="discount_code_quantity" value="{{$value->discount_code_quantity}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Điều kiện giảm giá</label>
                                <select class="form-control" name="discount_code_condition">
                                    @if($value->discount_code_condition ==1)
                                        <option selected value="1">--- Giảm theo tiền (đ) ---</option>
                                        <option value="2">--- Giảm theo phần trăm (%) ---</option>
                                    @elseif($value->discount_code_condition ==2)
                                        <option value="1">--- Giảm theo tiền (đ) ---</option>
                                        <option selected value="2">--- Giảm theo phần trăm (%) ---</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <labe>Giá giảm</labe>
                                <input type="text" name="discount_code_price" value="{{$value->discount_code_price}}" class="form-control" >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary modal-" type="submit">Cập nhật</button>
                        <button class="btn btn-secondary modal-close" type="button" data-dismiss="modal" aria-hidden="true">Hủy</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
