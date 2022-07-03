@extends('admin.admin_layout')
@section('admin_content')
    <div class="page-head">
        <h2 class="page-head-title">Quản lý thương hiệu sản phẩm</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Trang chủ</a></li>
                <li class="breadcrumb-item active">Quản lý thương hiệu sản phẩm</li>
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
                <form action="{{url('/admin/brand/import-excel-brand')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <input type="file" name="brand_file_import" accept=".xlsx">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-upload"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3">
                <form action="{{url('/admin/brand/export-excel-brand')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-6 mb-4" style="display: flex">
                        <button type="submit" class="btn btn-success"><i class="icon mdi mdi-download"></i></button>
                    </div>
                </form>
            </div>
            <div class="modal-overlay"></div>
            @include('admin.alert_admin')
        </div>
        @include('admin.brand.modal_create_brand')
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-header">Danh sách thương hiệu sản phẩm</div>
                    <div class="card-body">
                        <div class="table-responsive noSwipe">
                            <table id="TableBrand" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th style="width:4%;">
                                        <div class="custom-control custom-control-sm custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="check1">
                                            <label class="custom-control-label" for="check1"></label>
                                        </div>
                                    </th>
                                    <th>Tên thương hiệu sản phẩm</th>
                                    <th>Slug thương hiệu sản phẩm</th>
                                    <th>Mô tả thương hiệu sản phẩm</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brandIndex as $key => $value)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="check2">
                                                <label class="custom-control-label" for="check2"></label>
                                            </div>
                                        </td>
                                        <td class="user-avatar cell-detail user-info"><span>{{$value->brand_name}}</span></td>
                                        <td class="cell-detail"><span>{{$value->brand_slug}}</span></td>
                                        <td><span>{{$value->brand_description}}</span></td>
                                        <td class="cell-detail">
                                            @if($value->brand_status == 1)
                                                <a href="{{url('/admin/brand/update-brand-status-hide/'.$value->brand_id)}}"><span
                                                        class="text text-success">Hiển thị</span></a>
                                            @else
                                                <a href="{{url('/admin/brand/update-brand-status-display/'.$value->brand_id)}}"><span
                                                        class="text text-danger">Ẩn</span></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="md-trigger update_brand" data-toggle="modal"
                                               data-target="#update-modal{{$value->brand_id}}"><i
                                                    style="color: #0b66bc; font-size: 25px;"
                                                    class="icon mdi mdi-edit"></i></a>
                                            <a href="{{url('/admin/brand/delete-brand/'.$value->brand_id)}}"
                                               onclick="return confirm('Bạn muốn xóa thương hiệu này không?');"><i
                                                    style="color: red ; font-size: 25px;"
                                                    class="icon mdi mdi-delete"></i></a>
                                        </td>
                                        @include('admin.brand.modal_edit_brand')
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
