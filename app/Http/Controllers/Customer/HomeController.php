<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Product;
use App\Models\Category;
use App\Models\Gallery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showHome(){
        $allnewproduct = Product::orderBy('product_id','DESC')->where('product_status',1)->where('product_percent_discount','=',0)->get();
        $allsaleproduct = Product::orderBy('product_id','DESC')->where('product_status',1)->where('product_percent_discount','>',0)->get();
        $allcategoryparent = Category::where('category_status',1)->get();
        $allcategory = Category::where('category_status',1)->get();
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();

        $galleryarr = [];
        $galleryarr2 = [];
        foreach($allsaleproduct as $value){
            $gallery = Gallery::where('product_id',$value->product_id)->get();
            array_push($galleryarr,$gallery);
            $gallery_2 = Gallery::where('product_id',$value->product_id)->get();
            array_push($galleryarr2,$gallery_2);
        }
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('y-m-d');

        return view('customer.layout')->with(compact('date','galleryarr','galleryarr2','allnewproduct','allsaleproduct','allcategory','allcategoryparent','allcategoryparent1','allcategory1'));
    }
    // public function showAllNewProduct(){
    //   return view('customer.layout');
    // }
    public function searchProduct(Request $request){
        $allcategoryparent = Category::where('category_status',1)->get();
        $allcategory = Category::where('category_status',1)->get();
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();

        $keyword = $request->keyword;

        $products = Product::where('product_name','like','%'.$keyword.'%')->get();
        $productList = Product::where('product_name','like','%'.$keyword.'%')->get();

        return view('customer.product.product_search')->with(compact('allcategory','allcategoryparent','allcategoryparent1','allcategory1','products','productList'));
    }
    public function autocompleteSearch(Request $request){
        $data = $request->all();
        if($data['value']){
            $product = Product::where('product_status', 1)->where('product_name','like','%'.$data['value'].'%')->get();
            $output = '<ul class="dropdown-menu" style="display: block; position: relative;">';
            foreach($product as $key => $value){
                $output .= '
            <li><a>'.$value->product_name.'</a></li>
            ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function showAllBlog()
    {
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();
        $blog = Blog::orderBy('blog_id','DESC')->get();
        return view('customer.blog.all_blog')->with(compact('blog','allcategoryparent1','allcategory1'));
    }
    public function detailBlog($slug)
    {
        $blog = Blog::where('blog_slug',$slug)->first();
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();

        return view('customer.blog.blog_detail')->with(compact('blog','allcategoryparent1','allcategory1'));
    }
    public function showWistList()
    {
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();

        return view('customer.wistlist_all')->with(compact('allcategoryparent1','allcategory1'));
    }
    public function addWhistList(Request $request)
    {
        session()->put('whistList',$request->data_wishlist);
        session()->save();
    }
    public function addCompareProduct(Request $request)
    {
        session()->put('compare',$request->dataCompare);
        session()->save();
    }
}
