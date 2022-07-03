@extends('admin.admin_layout')
@section('admin_content')
    <div class="page-head">
        <h2 class="page-head-title">Quản lý gallery hình ảnh sản phẩm</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý gallery hình ảnh sản phẩm</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="mt-6 mb-4">
                    <button class="btn btn-space btn-success md-trigger" data-modal="nft-fullWidth">Thêm</button>
                </div>
                <div class="modal-overlay"></div>
            </div>
            <div class="col-lg-3">
                <form action="{{url('/admin/gallery/import-excel-gallery')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <input type="file" name="gallery_file_import" accept=".xlsx">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-upload"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
                <form action="{{url('/admin/gallery/export-excel-gallery')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-download"></i></button>
                    </div>
                </form>
            </div>
            @include('admin.alert_admin')
        </div>
        @include('admin.gallery.modal_create_gallery')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Danh sách gallery hình ảnh sản phẩm</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableGallery" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width:4%;">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check1">
                                            <label class="custom-control-label" for="check1"></label>
                                        </div>
                                    </th>
                                    <th>Tên hình ảnh</th>
                                    <th>Hình ảnh</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gallery as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="check2">
                                                <label class="custom-control-label" for="check2"></label>
                                            </div>
                                        </td>
                                        <td class="user-avatar cell-detail user-info">
                                            <span>{{$value->gallery_name}}</span></td>
                                        <td class="cell-detail"><img style="width: 50px; height: 50px;" src="{{asset('public/uploads/gallerys/'.$value->gallery_image)}}"></td>
                                        <td>
                                            <a class="md-trigger update_gallery" data-toggle="modal"
                                               data-target="#update-modal{{$value->gallery_id}}"><i
                                                    style="color: #0b66bc; font-size: 25px;"
                                                    class="icon mdi mdi-edit"></i></a>
                                            <a href="{{url('/admin/product/delete-gallery-product/'.$value->gallery_id)}}"
                                               onclick="return confirm('Bạn muốn xóa hình ảnh này không?');"><i
                                                    style="color: red ; font-size: 25px;"
                                                    class="icon mdi mdi-delete"></i></a>
                                        </td>
                                        @include('admin.gallery.modal_edit_gallery')
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

