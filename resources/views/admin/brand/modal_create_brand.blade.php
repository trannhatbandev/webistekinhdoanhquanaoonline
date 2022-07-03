<div class="row">
    <div class="full-width modal-container modal-effect-1 colored-header colored-header-primary "
         data-backdrop="static"
         data-keyboard="false" id="nft-fullWidth">
        <div class="modal-content full-width">
            <div class="modal-header modal-header-colored text-center">
                <h3 class="modal-title">Thêm thương hiệu sản phẩm</h3>
                <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span
                        class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{url('/admin/brand/create-brand')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Tên thương hiệu</label>
                            <input type="text" name="brand_name" id="slug" onkeyup="ChangeToSlug();"  value="{{old('brand_name')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Slug thương hiệu</label>
                            <input type="text" name="brand_slug" id="convert_slug" value="{{old('brand_slug')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Mô tả</label>
                            <textarea style="resize:none" rows="8" class="form-control" id="ckeditor3" name="brand_desc">{{old('brand_desc')}}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Trạng thái</label>
                            <select class="form-control" name="brand_status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
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
        </div>

    </div>
</div>
