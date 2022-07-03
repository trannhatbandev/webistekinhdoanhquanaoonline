<?php

namespace App\Http\Controllers\Admin\Attributes;

use App\Exports\AttributesExport;
use App\Http\Controllers\Controller;
use App\Imports\AttributesImport;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Product;
use App\Models\Color;
use App\Models\Attributes;
use Maatwebsite\Excel\Facades\Excel;

class ProductAttributesController extends Controller
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
    public function showCreateAttributesProduct(){
        $this->isLogin();
        $product = Product::orderBy('product_id','DESC')->get();
        $size = Size::orderBy('size_id','DESC')->get();
        $color = Color::orderBy('color_id','DESC')->get();
        return view('admin.attributes.create_product_attributes')->with(compact('product','size','color'));
    }
    public function createAttributesProduct(Request $request){
        $this->isLogin();
        $data = $request->validate(
            [
                'product' => 'required',
                'color' => 'required',
                'size' => 'required',
                'quantity' => 'required|numeric|min:1',
            ],
            [

                'quantity.required' => 'Số lượng phải có',
                'quantity.numeric' => 'Số lượng phải là số',
                'quantity.min' => 'Số lượng phải lớn hơn 0',

            ]
        );
        $attributesIsExists = Attributes::where('product_id',$data['product'])->where('size_id',$data['size'])->where('color_id',$data['color'])->first();

        if($attributesIsExists){
            Toastr::error("Thuộc tính sản phẩm đã có không thể thêm","Cảnh báo");
            return  \redirect()->back();
        }else{
            $attributes = new Attributes();
            $attributes->product_id = $data['product'];
            $attributes->size_id = $data['size'];
            $attributes->color_id = $data['color'];
            $attributes->quantity = $data['quantity'];

            $attributes->save();
            Toastr::success("Thêm thuộc tính sản phẩm thành công","Thành công");
            return  \redirect()->back();
        }
    }
    public function showListAttributesProduct(){
        $this->isLogin();
        $attributes = Attributes::orderBy('attributes_id','DESC')->get();
        $product = Product::orderBy('product_id','DESC')->get();
        $size = Size::orderBy('size_id','DESC')->get();
        $color = Color::orderBy('color_id','DESC')->get();
        return view('admin.attributes.show_list_product_attributes')->with(compact('attributes','product','size','color'));
    }
    public function updateAttributesProductQuantity(Request $request){
        $this->isLogin();
        $data = $request->all();
        $attributes = Attributes::find($data['attributes_id']);
        $attributes_quantity = $data['attributes_quantity'];
        $attributes->quantity = $attributes_quantity;
        $attributes->save();
    }
    public function deleteAttributesProduct($id){
        $this->isLogin();
        Attributes::find($id)->delete();
        Toastr::success("Xóa thuộc tính sản phẩm thành công","Thành công");
        return  \redirect()->back();
    }
    public function importExcelAttributesProduct(Request $request){
        $this->isLogin();
        $path = $request->file('attributes_product_file_import')->getRealPath();
        Excel::import(new AttributesImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelAttributesProduct(){
        $this->isLogin();
        return Excel::download(new AttributesExport(), 'attributes.xlsx');
    }
}
