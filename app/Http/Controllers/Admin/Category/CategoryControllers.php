<?php

namespace App\Http\Controllers\Admin\Category;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\CategoryImport;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class CategoryControllers extends Controller
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
    public  function  showListCategory(){
        $this->isLogin();
        $category = Category::orderBy('category_id','DESC')->get();
        $categoryIndex = Category::orderBy('category_id','DESC')->get();
        return view('admin.category.show_list_category')->with(compact('categoryIndex','category'));
    }
    public function createCategory(Request $request){
        $this->isLogin();
        $data = $request->validate(
            [
                'category_name' => 'required|unique:category|max:255',
                'category_slug' => 'required|unique:category|max:255',
                'category_description' => 'required',
                'category_status' => 'required',
                'category' => 'required',
            ],
            [
                'category_name.unique' => 'Tên danh mục đã có xin điền tên khác',
                'category_slug.unique' => 'Slug danh mục đã có xin điền tên khác',
                'category_name.required' => 'Tên danh mục phải có',
                'category_slug.required' => 'Slug danh mục phải có',
                'category_description.required' => 'Mô tả phải có',

            ]
        );
        $category = new Category();

        $category->category_name = $data['category_name'];
        $category->category_slug = $data['category_slug'];
        $category->category_parent = $data['category'];
        $category->category_description = $data['category_description'];
        $category->category_status = $data['category_status'];

        $category->save();
        Toastr::success("Thêm danh mục thành công","Thành công");
       return  Redirect::to("/admin/category/show-category");
    }
    public function deleteCategory($id){
        $this->isLogin();
        $category = Category::find($id);
        $categoryparent = Category::where('category_parent',$category->category_id)->first();
        $product = Product::where('category_id',$id)->first();
        if($categoryparent||$product){
            Toastr::error("Danh mục sản phẩm này đã có danh mục con hoặc đã có sản phẩm nên không thể xóa!","Không thành công");
            return redirect()->back();
            } else {
            Category::find($id)->delete();
            Toastr::success("Xóa danh mục thành công", "Thành công");
            return redirect()->back();
        }

    }

    public function updateCategory(Request $request, $id){
        $this->isLogin();
        $data = $request->validate(
            [
                'category_name' => 'required|max:255',
                'category_slug' => 'required|max:255',
                'category_description' => 'required',
                'category_status' => 'required',
                'category' => 'required',

            ],
            [
                'category_name.required' => 'Tên danh mục phải có',
                'category_slug.required' => 'Slug danh mục phải có',
                'category_description.required' => 'Mô tả phải có',

            ]
        );
        $category = Category::find($id);

        $category->category_name = $data['category_name'];
        $category->category_slug = $data['category_slug'];
        $category->category_parent = $data['category'];
        $category->category_description = $data['category_description'];
        $category->category_status = $data['category_status'];

        $category->save();

        Toastr::success("Cập nhật danh mục thành công","Thành công");
        return Redirect::to("/admin/category/show-category");

    }
    public function updateCategoryStatusHide($id){
        $this->isLogin();
        Category::where('category_id',$id)->update(['category_status'=>0]);
        Toastr::success("Ẩn danh mục thành công","Thành công");
        return \redirect()->back();
    }
    public function updateCategoryStatusDisplay($id){
        $this->isLogin();
        Category::where('category_id',$id)->update(['category_status'=>1]);
        Toastr::success("Hiển thị danh mục thành công","Thành công");
        return \redirect()->back();
    }
    public function importExcelCategory(Request $request){
        $this->isLogin();
        $path = $request->file('category_file_import')->getRealPath();
        Excel::import(new CategoryImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelCategory(){
        $this->isLogin();
        return Excel::download(new CategoryExport(), 'category.xlsx');
    }
}
