<?php

namespace App\Http\Controllers\Admin\Size;

use App\Exports\SizeExport;
use App\Http\Controllers\Controller;
use App\Imports\SizeImport;
use App\Models\Attributes;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Size;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class SizeController extends Controller
{
    public function isLogin()
    {
        $admin = session()->get('admin_id');

        if($admin){
            return redirect()->to('/admin/dashboard');
        }else{
            return redirect()->to(route('login'))->send();
        }
    }
    public  function  showListSize(){
        $this->isLogin();
        $sizeIndex = Size::orderBy('size_id','DESC')->get();
        return view('admin.size.show_list_size')->with(compact('sizeIndex'));
    }
    public function createSize(Request $request){
        $this->isLogin();
        $data = $request->validate(
            [
                'size_name' => 'required|unique:size|max:50',
                'size_slug' => 'required|unique:size|max:50',
                'size_desc' => 'required',
                'size_status' => 'required',
            ],
            [
                'size_name.unique' => 'Tên size đã có xin điền tên khác',
                'size_slug.unique' => 'Slug size đã có xin điền tên khác',
                'size_name.required' => 'Tên size phải có',
                'size_slug.required' => 'Slug size phải có',
                'size_desc.required' => 'Mô tả phải có',

            ]
        );
        $size = new Size();

        $size->size_name = $data['size_name'];
        $size->size_slug = $data['size_slug'];
        $size->size_description = $data['size_desc'];
        $size->size_status = $data['size_status'];

        $size->save();

        Toastr::success("Thêm size thành công","Thành công");
        return  Redirect::to("/admin/size/show-size");
    }
    public function deleteSize($id){
        $this->isLogin();
        $size = Size::find($id);
        $attributes = Attributes::where('size_id',$size->size_id)->first();
        if($attributes){
            Toastr::error("Size này là thuộc tính của sản phẩm nên không thể xóa!","Không thành công");
            return redirect()->back();
        } else {
            $size->delete();
            Toastr::success("Xóa size thành công","Thành công");
            return redirect()->back();
        }
    }
    public function updateSize(Request $request, $id){
        $this->isLogin();
        $data = $request->validate(
            [
                'size_name' => 'required|max:255',
                'size_slug' => 'required|max:255',
                'size_desc' => 'required',
                'size_status' => 'required',
            ],
            [
                'size_name.required' => 'Tên size phải có',
                'size_slug.required' => 'Slug size phải có',
                'size_desc.required' => 'Mô tả phải có',

            ]
        );
        $size = Size::find($id);

        $size->size_name = $data['size_name'];
        $size->size_slug = $data['size_slug'];
        $size->size_description = $data['size_desc'];
        $size->size_status = $data['size_status'];

        $size->save();

        Toastr::success("Cập nhật danh mục thành công","Thành công");
        return Redirect::to("/admin/size/show-size");

    }
    public function updateSizeStatusHide($id){
        $this->isLogin();
        Size::where('size_id',$id)->update(['size_status'=>0]);
        Toastr::success("Ẩn size thành công","Thành công");
        return \redirect()->back();
    }
    public function updateSizeStatusDisplay($id){
        $this->isLogin();
        Size::where('size_id',$id)->update(['size_status'=>1]);
        Toastr::success("Hiển thị size thành công","Thành công");
        return \redirect()->back();
    }
    public function importExcelSize(Request $request){
        $this->isLogin();
        $path = $request->file('size_file_import')->getRealPath();
        Excel::import(new SizeImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelSize(){
        $this->isLogin();
        return Excel::download(new SizeExport(), 'size.xlsx');
    }
}
