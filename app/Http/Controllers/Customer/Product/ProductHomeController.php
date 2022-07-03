<?php

namespace App\Http\Controllers\Customer\Product;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Color;
use App\Models\Comment;
use App\Models\Size;
use App\Models\StartRating;
use Illuminate\Http\Request;

class ProductHomeController extends Controller
{
    public function showProductDetail($slug){
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();
        $product_detail = Product::where('product_slug',$slug)->first();
        $category_id = $product_detail->category_id;
        $product_relate = Product::where('category_id',$category_id)->get();

        $sizes = Attributes::where('product_id',$product_detail->product_id)->get();
        $count = $sizes->count();
        $arraycolorname = array();
        $arraycolorcode = array();
        $arraysize = array();
        $quantity =0;
        if($count >0){

            foreach ($sizes as $key => $value) {
                array_push($arraysize, $value->size->size_name);
            };
            $arraysize = array_unique($arraysize);

            $colors = Attributes::where('product_id',$product_detail->product_id)->get();

            foreach ($colors as $key => $value) {
                array_push($arraycolorname, $value->color->color_name);
            };
            $arraycolorname = array_unique($arraycolorname);

            foreach ($colors as $key => $value) {
                array_push($arraycolorcode, $value->color->color_code);
            };
            $arraycolorcode = array_unique($arraycolorcode);

            $sizefirst = Size::where('size_name',$arraysize[0])->first();
            $colorfirst = Color::where('color_name',$arraycolorname[0])->first();
            if($sizefirst&&$colorfirst){
                $attributesFirst = Attributes::where('size_id',$sizefirst ->size_id)->where('color_id',$colorfirst->color_id)
                ->where('product_id',$product_detail->product_id)->first();
                if($attributesFirst){
                    $quantity = $attributesFirst->quantity;
                }
            }
        }

        $countcomment=0;
        $comment = Comment::where('product_id',$product_detail->product_id)->get();
        if($comment){
            $countcomment = count($comment);
        }


        $product = Product::where('product_id',$product_detail->product_id)->first();
        $product->product_customer_views = $product->product_customer_views + 1;
        $product->save();

        $starRating = StartRating::where('product_id',$product_detail->product_id)->avg('rating');
        $starRating = round($starRating);

        $gallery = Gallery::where('product_id',$product_detail->product_id)->get();
        $gallery_2 = Gallery::where('product_id',$product_detail->product_id)->get();

        return view('customer.product.product_detail')->with(compact('countcomment','quantity','allcategory1','allcategoryparent1','product_detail','product_relate','arraysize','arraycolorname','arraycolorcode','starRating','gallery','gallery_2'));
    }
    public function showProductWithCategory($slug){
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();
        $category = Category::where('category_status',1)->where('category_slug',$slug)->first();
        $products = Product::where('product_status',1)->where('category_id',$category->category_id)->get();
        $productList = Product::where('product_status',1)->where('category_id',$category->category_id)->get();
        return view('customer.product.product_with_category')->with(compact('products','allcategoryparent1','allcategory1','productList'));
    }
    public function showAllProduct(){
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();
        $max = Product::max('product_price');
        $min = Product::min('product_price');

        if(isset($_GET['sort-by'])){
            $sortBy = $_GET['sort-by'];

            if($sortBy=="az"){
                $products = Product::where('product_status',1)->orderBy('product_name','ASC')->paginate(6);
                $productList = Product::where('product_status',1)->orderBy('product_name','ASC')->paginate(6)->appends(request()->query());
            }elseif($sortBy=="za"){
                $products = Product::where('product_status',1)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());
                $productList = Product::where('product_status',1)->orderBy('product_name','DESC')->paginate(6)->appends(request()->query());
            }elseif($sortBy=="lowtohight"){
                $products = Product::where('product_status',1)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());
                $productList = Product::where('product_status',1)->orderBy('product_price','ASC')->paginate(6)->appends(request()->query());
            }elseif($sortBy=="highttolow"){
                $products = Product::where('product_status',1)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());
                $productList = Product::where('product_status',1)->orderBy('product_price','DESC')->paginate(6)->appends(request()->query());
            }else{
                $products = Product::where('product_status',1)->get();
                $productList = Product::where('product_status',1)->get();
            }
        }else{
            $products = Product::where('product_status',1)->get();
            $productList = Product::where('product_status',1)->get();
        }
        if(isset($_GET['price-start']) && isset($_GET['price-end'])){
            $priceStart = $_GET['price-start'];
            $priceEnd = $_GET['price-end'];

            $products = Product::where('product_status',1)->whereBetween('product_price',[$priceStart,$priceEnd])->paginate(6);
            $productList = Product::where('product_status',1)->whereBetween('product_price',[$priceStart,$priceEnd])->paginate(6);
        }else{
            $products = Product::where('product_status',1)->get();
            $productList = Product::where('product_status',1)->get();

        }
        // if($category!=null){

        //     $products = Product::where('product_status',1)->where('category_id',$category)->paginate(6);
        //     $productList = Product::where('product_status',1)->where('category_id',$category)->paginate(6);
        // }else{
        //     $products = Product::where('product_status',1)->get();
        //     $productList = Product::where('product_status',1)->get();

        // }
        return view('customer.product.product_all')->with(compact('products',
        'allcategoryparent1','allcategory1','productList','min','max'));
    }
    public function quickViewProduct(Request $request){
        $product_id = $request->product_id;
        $productqv = Product::find($product_id);

        $html['product_name'] = $productqv->product_name;
        $html['product_image'] ='<a data-fancybox="images" href=""><img src="'.asset("public/uploads/products/".$productqv->product_image).'" alt="product-view"></a>';
        $html['product_price'] = $productqv->product_price;
        $html['product_price_sale'] = $productqv->product_price_sale;
        $html['product_description'] = $productqv->product_description;

        $html['quick_view']= '
        <input type="hidden" value="'.$productqv->product_id.'" class="cart_product_id_'.$productqv->product_id.'">
        <input type="hidden" value="'.$productqv->product_name.'" class="cart_product_name_'.$productqv->product_id.'">
        <input type="hidden" value="'.$productqv->product_image.'" class="cart_product_image_'.$productqv->product_id.'">
        <input type="hidden" value="'.$productqv->product_price.'" class="cart_product_price_'.$productqv->product_id.'">
        <input type="hidden" value="1" class="cart_product_qty_'.$productqv->product_id.'">';

        $html['button_quickview'] = '<button style="margin-top: 10px" data-id_product="'.$productqv->product_id.'" type="button"
        class="btn btn-primary add-cart-quick-view" >Thêm vào giỏ hàng</button>';

        $sizes = Attributes::where('product_id',$product_id)->get();
        $arraysize = array();
        foreach ($sizes as $key => $value) {
            array_push($arraysize, $value->size->size_name);
        };
        $arraysize = array_unique($arraysize);

        $html['product_size_first']= '';
        if($arraysize>0){
            $html['product_size_first'].= ' <button type="button" data-product_id="'.$product_id.'"  value="'.$arraysize[0].'" class="size selected">'.$arraysize[0].'</button>';
        }

        $html['product_size']= '';
        if($arraysize!=null){
            for($i=1; $i< count($arraysize);$i++){
                $html['product_size'].= ' <button type="button" data-product_id="'.$product_id.'"  value="'.$arraysize[$i].'" class="size">'.$arraysize[$i].'</button>';
            }
        }

        $colors = Attributes::where('product_id',$product_id)->get();
        $arraycolorname = array();
        foreach ($colors as $key => $value) {
            array_push($arraycolorname, $value->color->color_name);
        };
        $arraycolorname = array_unique($arraycolorname);
        $html['product_color_first']= '';
        if(count($arraycolorname)>0){
            $html['product_color_first'].= '<button type="button" data-product_id="'.$product_id.'"  class="colour select" value="'.$arraycolorname[0].'" style="color: black;">
            '.$arraycolorname[0].'
            </button>';
        }
        $arraycolorcode = array();
        foreach ($colors as $value) {
            array_push($arraycolorcode, $value->color->color_code);
        };
        $arraycolorcode = array_unique($arraycolorcode);

        $html['product_color']= '';
        if(count($arraycolorname)>0 && count($arraycolorcode)>0){
            for($i=1; $i<count($arraycolorname);$i++){
                for($j=1; $j<count($arraycolorcode);$j++){
                    if($i==$j){
                        $html['product_color'].= ' <button type="button" data-product_id="'.$product_id.'" class="colour" value="'.$arraycolorname[$i].'" style="color: black;"
                        data-colour="'.$arraycolorcode[$i].'">'.$arraycolorname[$i].'</button>';
                    }
                }
            }
        }

        echo json_encode($html);
    }
    public function insertRatingProduct(Request $request){
        $data = $request->all();

        $startRating = new StartRating();
        $startRating->product_id = $data['product_id'];
        $startRating->rating = $data['position'];
        $startRating->save();
        echo 'ok';
    }
    public function showProductCompare()
    {
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();
        return view('customer.product.product_compare')->with(compact('allcategoryparent1','allcategory1'));
    }
    public function selectColorDetail(Request $request){
        $data = $request->all();
        $html= '';
        if($data['action_change']){
            if($data['action_change']=="size-detail") {
                $size = Size::where('size_name', $data['size'])->first();
                $product_id = $data['product_id'];
                $colors = Attributes::where('product_id', $data['product_id'])->where('size_id', $size->size_id)->get();

                $arraycolor = array();
                foreach ($colors as $key => $value) {
                    array_push($arraycolor, $value->color->color_name);
                };
                $arraycolor = array_unique($arraycolor);

                foreach ($arraycolor as $key => $color) {
                    $html .= '<li style="margin-left: 10px"><input style="width: 12px" checked type="radio" data-id="'.$product_id.'" name="color-detail-checked" value="'.$color.'">
                    <label for="color['.$product_id.']">'.$color.'</label><br></li>';
                }
            }
        }
        echo  $html;
    }
    public function checkTheAmountInventory(Request $request)
    {
        $data = $request->all();

        $quantityInventory = 0;
        if($data['product_id']!=''){
            $size = Size::where('size_name',$data['size'])->first();
            $color = Color::where('color_name',$data['color'])->first();

            $attributes = Attributes::where('product_id',$data['product_id'])->where('size_id',$size->size_id)
            ->where('color_id',$color->color_id)->get();

            if($attributes){
                foreach($attributes as $value){
                    $quantityInventory = $value->quantity;
                }
            }
        }
        echo $html = $quantityInventory.' sản phẩm';
    }
}
