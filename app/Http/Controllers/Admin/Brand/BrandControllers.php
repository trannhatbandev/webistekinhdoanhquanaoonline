<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Brand;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;
use App\Imports\BrandImport;
use App\Exports\BrandExport;
use Maatwebsite\Excel\Facades\Excel;
class BrandControllers extends Controller
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
    public  function  showListBrand(){
        $this->isLogin();
        $brandIndex = Brand::orderBy('brand_id','DESC')->get();
        return view('admin.brand.show_list_brand')->with(compact('brandIndex'));
    }
    public function createBrand(Request $request){
        $this->isLogin();
        $data = $request->validate(
            [
                'brand_name' => 'required|unique:brand|max:255',
                'brand_slug' => 'required|unique:brand|max:255',
                'brand_desc' => 'required',
                'brand_status' => 'required',

            ],
            [
                'brand_name.unique' => 'Tên danh mục đã có xin điền tên khác',
                'brand_slug.unique' => 'Slug danh mục đã có xin điền tên khác',
                'brand_name.required' => 'Tên danh mục phải có',
                'brand_slug.required' => 'Slug danh mục phải có',
                'brand_desc.required' => 'Mô tả phải có',

            ]
        );
        $brand = new Brand();

        $brand->brand_name = $data['brand_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_description = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];

        $brand->save();

        Toastr::success("Thêm thương hiệu thành công","Thành công");
        return  Redirect::to("/admin/brand/show-brand");
    }
    public function deleteBrand($id){
        $this->isLogin();
        $product = Product::where('brand_id',$id)->first();
        if($product !=null){
            Toastr::error("Thương hiệu này đã có sản phẩm không được xóa!","Không thành công");
            return redirect()->back();
        }else{
            Brand::find($id)->delete();
            Toastr::success("Xóa thương hiệu thành công","Thành công");
            return redirect()->back();

        }

    }
    public function updateBrand(Request $request, $id){
        $this->isLogin();
        $data = $request->validate(
            [
                'brand_name' => 'required|max:255',
                'brand_slug' => 'required|max:255',
                'brand_desc' => 'required',
                'brand_status' => 'required',

            ],
            [
                'brand_name.required' => 'Tên thương hiệu phải có',
                'brand_slug.required' => 'Slug thương hiệu phải có',
                'brand_desc.required' => 'Mô tả phải có',

            ]
        );
        $brand = Brand::find($id);

        $brand->brand_name = $data['brand_name'];
        $brand->brand_slug = $data['brand_slug'];
        $brand->brand_description = $data['brand_desc'];
        $brand->brand_status = $data['brand_status'];

        $brand->save();

        Toastr::success("Cập nhật thương hiệu thành công","Thành công");
        return Redirect::to("/admin/brand/show-brand");

    }
    public function updateBrandStatusHide($id){
        $this->isLogin();
        Brand::where('brand_id',$id)->update(['brand_status'=>0]);
        Toastr::success("Ẩn thương hiệu thành công","Thành công");
        return \redirect()->back();
    }
    public function updateBrandStatusDisplay($id){
        $this->isLogin();
        Brand::where('brand_id',$id)->update(['brand_status'=>1]);
        Toastr::success("Hiển thị thương hiệu thành công","Thành công");
        return \redirect()->back();
    }
    public function importExcelBrand(Request $request){
        $this->isLogin();
        $path = $request->file('brand_file_import')->getRealPath();
        Excel::import(new BrandImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelBrand(){
        $this->isLogin();
        return Excel::download(new BrandExport, 'brand.xlsx');
    }
}
