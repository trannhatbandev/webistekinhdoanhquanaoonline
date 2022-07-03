<div class="row">
    <form action="{{url('/admin/color/update-color/'.$value->color_id)}}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal fade text-left colored-header colored-header-primary" id="update-modal{{$value->color_id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Cập nhật màu sắc</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Tên màu sắc</label>
                                <input type="text" name="color_name" id="slug" onkeyup="ChangeToSlug();" value="{{$value->color_name}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Slug màu sắc</label>
                                <input type="text" name="color_slug" id="convert_slug" value="{{$value->color_slug}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Màu sắc</label>
                                <input type="color" name="color_code"  value="{{$value->color_code}}" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>Trạng thái</label>
                                <select class="form-control" name="color_status">
                                    @if($value->color_status==1)
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
