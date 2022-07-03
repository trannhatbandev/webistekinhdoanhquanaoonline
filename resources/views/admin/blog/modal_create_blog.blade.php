<div class="row">
    <div class="full-width modal-container modal-effect-1 colored-header colored-header-primary "
         data-backdrop="static"
         data-keyboard="false" id="nft-fullWidth">
        <div class="modal-content full-width">
            <div class="modal-header modal-header-colored text-center">
                <h3 class="modal-title">Thêm bài viết</h3>
                <button class="close modal-close" type="button" data-dismiss="modal" aria-hidden="true"><span
                        class="mdi mdi-close"></span></button>
            </div>
            <div class="modal-body">
                <form role="form" method="post" action="{{url('/admin/blog/create-blog')}}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>Tên bài viết</label>
                            <input type="text" name="blog_title" id="slug" onkeyup="ChangeToSlug();"  value="{{old('blog_title')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Slug bài viết</label>
                            <input type="text" name="blog_slug" id="convert_slug" value="{{old('blog_slug')}}" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Hình ảnh</label>
                            <input type="file" name="blog_image">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Trạng thái</label>
                            <select class="form-control" name="blog_status">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Mô tả bài viết</label>
                            <textarea style="resize:none" rows="8" class="form-control" name="blog_description">{{old('blog_description')}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nội dung bài viết</label>
                            <textarea style="resize:none" rows="8" class="form-control" name="blog_content">{{old('blog_content')}}</textarea>
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
