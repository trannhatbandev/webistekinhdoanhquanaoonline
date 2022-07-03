@extends('admin.admin_layout')
@section('admin_content')
    <div class="page-head">
        <h2 class="page-head-title">Quản lý thuộc tính sản phẩm</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý thuộc tính sản phẩm</li>
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
                <form action="{{url('/admin/attributes-product/import-excel-attributes-product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <input type="file" name="attributes_product_file_import" accept=".xlsx">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-upload"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
                <form action="{{url('/admin/attributes-product/export-excel-attributes-product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-download"></i></button>
                    </div>
                </form>
            </div>
            @include('admin.alert_admin')
        </div>
        @include('admin.attributes.modal_create_product_attributes')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Danh sách thuộc tính sản phẩm</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableAttributes" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width:4%;">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check1">
                                            <label class="custom-control-label" for="check1"></label>
                                        </div>
                                    </th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size</th>
                                    <th>Màu</th>
                                    <th>Số lượng</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes  as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="check2">
                                                <label class="custom-control-label" for="check2"></label>
                                            </div>
                                        </td>
                                        <td>{{$value->product->product_name}}</td>
                                        <td>{{$value->size->size_name}}</td>
                                        <td>{{$value->color->color_name}}</td>
                                        <td contenteditable data-attributes_product_quantity="{{$value->attributes_id}}" class="attributes_product_quantity_edit">{{$value->quantity}}</td>
                                        <td>
                                            <a href="{{url('/admin/attributes-product/delete-attributes-product/'.$value->attributes_id)}}"
                                               onclick="return confirm('Bạn muốn xóa thuộc tính này không?');"><i style="color: red ; font-size: 25px;" class="icon mdi mdi-delete"></i></a>
                                        </td>
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




