<?php

namespace App\Http\Controllers\Admin\Color;

use App\Exports\ColorExport;
use App\Http\Controllers\Controller;
use App\Imports\ColorImport;
use App\Models\Attributes;
use App\Models\Color;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ColorController extends Controller
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
    public  function  showListColor(){
        $this->isLogin();
        $colorIndex = color::orderBy('color_id','DESC')->get();
        return view('admin.color.show_list_color')->with(compact('colorIndex'));
    }
    public function createColor(Request $request){
        $this->isLogin();
        $data = $request->validate(
            [
                'color_name' => 'required|unique:color|max:50',
                'color_slug' => 'required|unique:color|max:50',
                'color_code' => 'required|max:50',
                'color_status' => 'required',
            ],
            [
                'color_name.unique' => 'Tên màu đã có xin điền tên khác',
                'color_slug.unique' => 'Slug màu đã có xin điền tên khác',
                'color_name.required' => 'Tên màu phải có',
                'color_slug.required' => 'Slug màu phải có',
                'color_code.required' => 'Mã màu phải có',
            ]
        );
        $color = new Color();

        $color->color_name = $data['color_name'];
        $color->color_slug = $data['color_slug'];
        $color->color_code = $data['color_code'];
        $color->color_status = $data['color_status'];

        $color->save();

        Toastr::success("Thêm màu sản phẩm thành công","Thành công");
        return  Redirect::to("/admin/color/show-color");
    }
    public function deleteColor($id){
        $this->isLogin();
        $color = Color::find($id);
        $attributes = Attributes::where('color_id',$color->color_id)->first();
        if($attributes){
            Toastr::error("Màu này là thuộc tính của sản phẩm nên không thể xóa!","Không thành công");
            return redirect()->back();
        } else {
            $color->delete();
            Toastr::success("Xóa màu sản phẩm thành công","Thành công");
            return redirect()->back();
        }
    }
    public function updateColor(Request $request, $id){
        $this->isLogin();
        $data = $request->validate(
            [
                'color_name' => 'required|max:50',
                'color_slug' => 'required|max:50',
                'color_code' => 'required|max:50',
                'color_status' => 'required',
            ],
            [
                'color_name.required' => 'Tên màu phải có',
                'color_slug.required' => 'Slug màu phải có',
                'color_code.required' => 'Mã màu phải có',

            ]
        );
        $color = Color::find($id);

        $color->color_name = $data['color_name'];
        $color->color_slug = $data['color_slug'];
        $color->color_code = $data['color_code'];
        $color->color_status = $data['color_status'];

        $color->save();

        Toastr::success("Cập nhật màu sản phẩm thành công","Thành công");
        return Redirect::to("/admin/color/show-color");

    }
    public function updateColorStatusHide($id){
        $this->isLogin();
        Color::where('color_id',$id)->update(['color_status'=>0]);
        Toastr::success("Ẩn màu sản phẩm thành công","Thành công");
        return \redirect()->back();
    }
    public function updateColorStatusDisplay($id){
        $this->isLogin();
        Color::where('color_id',$id)->update(['color_status'=>1]);
        Toastr::success("Hiển thị màu sản phẩm thành công","Thành công");
        return \redirect()->back();
    }
    public function importExcelColor(Request $request){
        $this->isLogin();
        $path = $request->file('color_file_import')->getRealPath();
        Excel::import(new ColorImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelColor(){
        $this->isLogin();
        return Excel::download(new ColorExport(), 'color.xlsx');
    }
}
