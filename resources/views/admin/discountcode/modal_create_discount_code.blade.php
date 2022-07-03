<div class="row">
    <div class="full-width modal-container modal-effect-1 colored-header colored-header-primary "
         data-backdrop="static"
         data-keyboard="false" id="nft-fullWidth">
        <div class="modal-content full-width">
            <div class="modal-header modal-header-colored text-center">
                <h3 class="modal-title">Thêm mã khuyến mãi</h3>
                <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span
                        class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{url('/admin/discount-code/create-discount-code')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Tên khuyến mãi</label>
                            <input type="text" name="discount_code_name" value="{{old('discount_code_name')}}" class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Mã khuyến mãi</label>
                            <input type="text" name="discount_code_code" value="{{old('discount_code_code')}}"  class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Số lượng mã</label>
                            <input type="text" name="discount_code_quantity"   value="{{old('discount_code_quantity')}}"  class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Điều kiện giảm giá</label>
                            <select class="form-control" name="discount_code_condition">
                                <option value="0">--- Vui lòng chọn ---</option>
                                <option value="1">--- Giảm theo tiền (đ)---</option>
                                <option value="2">--- Giảm theo phần trăm (%) ---</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Giá giảm</label>
                            <input type="text" name="discount_code_price" value="{{old('discount_code_price')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Ngày bắt đầu</label>
                            <input type="text" value="{{old('discount_code_date_start')}}"
                            name="discount_code_date_start" id="discount-code-date-start" class="form-control" >
                        </div>
                        <div class="form-group col-md-3">
                            <label>Ngày kết thúc</label>
                            <input type="text"  value="{{old('discount_code_date_end')}}"
                            name="discount_code_date_end" id="discount-code-date-end"  class="form-control" >
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



