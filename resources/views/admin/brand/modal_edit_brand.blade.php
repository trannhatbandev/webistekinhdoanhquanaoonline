<div class="row">
    <form action="{{url('/admin/brand/update-brand/'.$value->brand_id)}}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left colored-header colored-header-primary" id="update-modal{{$value->brand_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cập nhật thương hiệu</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Tên thương hiệu</label>
                                <input type="text" name="brand_name" id="slug" onkeyup="ChangeToSlug();" value="{{$value->brand_name}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Slug thương hiệu</label>
                                <input type="text" name="brand_slug" id="convert_slug" value="{{$value->brand_slug}}" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Mô tả</label>
                                <textarea style="resize:none" rows="8" class="form-control" name="brand_desc" >{{$value->brand_description}}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Trạng thái</label>
                                <select class="form-control" name="brand_status">
                                    @if($value->brand_status==1)
                                        <option selected value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="1">Hiển thị</option>
                                        <option  selected value="0">Ẩn</option>
                                    @endif
                                </select>
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
