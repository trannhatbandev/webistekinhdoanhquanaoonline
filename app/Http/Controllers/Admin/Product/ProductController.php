<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
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
    public function showListProduct()
    {
        $this->isLogin();
        $product = Product::orderBy('product_id', 'DESC')->get();
        $brand = Brand::orderBy('brand_id', 'DESC')->get();
        $category = Category::all();
        return view('admin.product.show_list_product')->with(compact('product', 'brand', 'category'));
    }

    public function createProduct(Request $request)
    {
        $this->isLogin();
        $data = $request->validate(
            [
                'product_name' => 'required|unique:product|max:255',
                'product_slug' => 'required|unique:product|max:255',
                'product_desc' => 'required',
                'product_status' => 'required',
                'product_price' => 'required|min:1|numeric',
                'product_price_cost'=> 'required|min:1|numeric',
                'product_percent_discount'=>'required|numeric',
                'product_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
                'product_date_sale_start'=>'',
                'product_date_sale_end'=>'',
                'category' => 'required',
                'brand' => 'required',
            ],
            [
                'product_name.unique' => 'Tên sản phẩm đã có xin điền tên khác',
                'product_slug.unique' => 'Slug sản phẩm đã có xin điền tên khác',
                'product_name.required' => 'Tên sản phẩm phải có',
                'product_slug.required' => 'Slug sản phẩm phải có',
                'product_price.required' => 'Giá sản phẩm phải có',
                'product_price.min' => 'Giá sản phẩm phải lớn hơn 1',
                'product_price.numeric' => 'Giá sản phẩm phải là số',
                'product_price_cost.required' => 'Giá sản phẩm phải có',
                'product_price_cost.min' => 'Giá sản phẩm phải lớn hơn 1',
                'product_price_cost.numeric' => 'Giá sản phẩm phải là số',
                'product_percent_discount.required' => 'Giá sản phẩm phải có',
                'product_percent_discount.min' => 'Giá sản phẩm phải lớn hơn 1',
                'product_percent_discount.numeric' => 'Giá sản phẩm phải là số',
                'product_image.required' => 'Hình ảnh phải có',
                'product_image.image' => 'Phải là file hình ảnh',
                'product_image.mimes' => 'Phải sử dụng những định dạng sau: jpg, png, jpeg, gif, svg',
                'product_desc.required' => 'Mô tả sản phẩm phải có',
            ]
        );

        $product = new Product();

        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug'];
        $product->product_description = $data['product_desc'];
        $product->product_price = $data['product_price'];
        $product->product_percent_discount = $data['product_percent_discount'];
        $product->product_price_cost = $data['product_price_cost'];

        if($data['product_date_sale_start'] && $data['product_date_sale_end']){
            $product->product_date_sale_start = $data['product_date_sale_start'];
            $product->product_date_sale_end = $data['product_date_sale_end'];
        }else{
            $product->product_date_sale_start = 0;
            $product->product_date_sale_end = 0;
        }


        if($data['product_percent_discount']>0){
            $product->product_price_sale = $data['product_price']-($data['product_price']*($data['product_percent_discount'])/100);
        }else{
            $product->product_price_sale = 0;
        }
        $product->product_status = $data['product_status'];
        $product->category_id = $data['category'];
        $product->brand_id = $data['brand'];

        $get_image = $request->product_image;
        $path = 'public/uploads/products/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);

        $product->product_image = $new_image;

        $product->save();

        Toastr::success("Thêm sản phẩm thành công", "Thành công");
        return redirect()->back();
    }

    public function deleteProduct($id)
    {
        $this->isLogin();
        $product = Product::find($id);
        $attributes = Attributes::where('product_id', $product->product_id)->first();
        if ($attributes) {
            Toastr::error("Sản phẩm này đã có thuộc tính nên không thể xóa!", "Không thành công");
            return redirect()->back();
        } else {
            $path = 'public/uploads/products/' . $product->product_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $product->delete();
            Toastr::success("Xóa sản phẩm thành công", "Thành công");
            return redirect()->back();
        }

    }

    public function updateProduct(Request $request, $id)
    {
        $this->isLogin();
        $data = $request->validate(
            [
                'product_name' => 'required|max:255',
                'product_slug' => 'required|max:255',
                'product_desc' => 'required',
                'product_status' => 'required',
                'product_price' => 'required|min:1|numeric',
                'product_price_cost'=> 'required|numeric',

                'product_percent_discount'=>'required|min:1|numeric',
                'product_image' => 'image|mimes:jpg,png,jpeg,gif,svg',
                'category' => 'required',
                'brand' => 'required',
            ],
            [
                'product_name.unique' => 'Tên sản phẩm đã có xin điền tên khác',
                'product_slug.unique' => 'Slug sản phẩm đã có xin điền tên khác',
                'product_name.required' => 'Tên sản phẩm phải có',
                'product_slug.required' => 'Slug sản phẩm phải có',
                'product_price.required' => 'Giá sản phẩm phải có',
                'product_price.min' => 'Giá sản phẩm phải lớn hơn 1',
                'product_price.numeric' => 'Giá sản phẩm phải là số',
                'product_price_cost.required' => 'Giá sản phẩm phải có',
                'product_price_cost.min' => 'Giá sản phẩm phải lớn hơn 1',
                'product_price_cost.numeric' => 'Giá sản phẩm phải là số',
                'product_percent_discount.required' => 'Giá sản phẩm phải có',
                'product_percent_discount.min' => 'Giá sản phẩm phải lớn hơn 1',
                'product_percent_discount.numeric' => 'Giá sản phẩm phải là số',
                'product_image.image' => 'Phải là file hình ảnh',
                'product_image.mimes' => 'Phải sử dụng những định dạng sau: jpg, png, jpeg, gif, svg',
                'product_desc.required' => 'Mô tả sản phẩm phải có',
            ]
        );
        $product = Product::find($id);

        $product->product_name = $data['product_name'];
        $product->product_slug = $data['product_slug'];
        $product->product_description = $data['product_desc'];
        $product->product_price = $data['product_price'];
        $product->product_percent_discount = $data['product_percent_discount'];
        $product->product_price_cost = $data['product_price_cost'];
        $product->product_price_sale = $data['product_price']-($data['product_price']*($data['product_percent_discount']/100));
        $product->product_status = $data['product_status'];
        $product->category_id = $data['category'];
        $product->brand_id = $data['brand'];

        $get_image = $request->product_image;
        if ($get_image) {
            $path = 'public/uploads/products/' . $product->product_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/products/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $product->product_image = $new_image;
        }
        $product->save();
        Toastr::success("Cập nhật sản phẩm thành công", "Thành công");
        return \redirect()->back();

    }

    public function updateProductStatusHide($id)
    {
        $this->isLogin();
        Product::where('product_id', $id)->update(['product_status' => 0]);
        Toastr::success("Ẩn sản phẩm thành công", "Thành công");
        return \redirect()->back();
    }

    public function updateProductStatusDisplay($id)
    {
        $this->isLogin();
        Product::where('product_id', $id)->update(['product_status' => 1]);
        Toastr::success("Hiển thị sản phẩm thành công", "Thành công");
        return \redirect()->back();
    }

    public function showCreateGalleryProduct($id)
    {
        $this->isLogin();
        $product_id = $id;
        $gallery = Gallery::where('product_id', $product_id)->get();
        return view('admin.gallery.show_list_gallery')->with(compact('product_id', 'gallery'));
    }

    public function createGalleryProduct(Request $request, $product_id)
    {
        $this->isLogin();
        $data = $request->validate([
            'gallery_image' => 'required',
            'gallery_image.*' => 'image|mimes:jpg,png,jpeg,gif,svg',

        ],
        [
            'gallery_image.image' => 'Phải là file hình ảnh',
            'gallery_image.mimes' => 'Phải sử dụng những định dạng sau: jpg, png, jpeg, gif, svg',

        ]);

        if ($data['gallery_image']) {
            foreach ($data['gallery_image'] as $item) {
                $path = 'public/uploads/gallerys/';
                $get_name_image = $item->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 99) . '.' . $item->getClientOriginalExtension();
                $item->move($path, $new_image);

                $gallery = new Gallery();
                $gallery->gallery_name = $new_image;
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
        }
        Toastr::success("Thêm gallery hình ảnh sản phẩm thành công", "Thành công");
        return \redirect()->back();
    }

    public function deleteGalleryProduct($id)
    {
        $this->isLogin();
        $gallery = Gallery::find($id);
        $path = 'public/uploads/gallerys/'.$gallery->gallery_image;
        if (file_exists($path)) {
            unlink($path);
        }
        $gallery->delete();
        Toastr::success("Xóa gallery hình ảnh sản phẩm thành công", "Thành công");
        return redirect()->back();
    }
    public function updateGalleryProduct(Request $request, $id){
        $this->isLogin();
        $data = $request->validate(
            [
                'gallery_image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',

            ],
            [
                'gallery_image.image' => 'Phải là file hình ảnh',
                'gallery_image.mimes' => 'Phải sử dụng những định dạng sau: jpg, png, jpeg, gif, svg',

            ]
        );
        $gallery = Gallery::find($id);

        $get_image = $request->gallery_image;
        if ($get_image) {
            $path = 'public/uploads/gallerys/' . $gallery->gallery_image;
            if (file_exists($path)) {
                unlink($path);
            }
            $path = 'public/uploads/gallerys/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);

            $gallery->gallery_image = $new_image;
            $gallery->gallery_name = $new_image;
        }
        $gallery->save();
        Toastr::success("Cập nhật gallery hình ảnh sản phẩm thành công", "Thành công");
        return \redirect()->back();
    }
}
