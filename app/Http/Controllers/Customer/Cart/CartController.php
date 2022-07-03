<?php

namespace App\Http\Controllers\Customer\Cart;
use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\District;
use App\Models\Product;
use App\Models\Size;
use App\Models\TransportFee;
use App\Models\Ward;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function showCart(){
        $city = City::orderBy('matp','ASC')->get();
        $district = District::orderBy('maqh','ASC')->get();
        $ward = Ward::orderBy('maxptt','ASC')->get();
        $allcategoryparent1 = Category::where('category_status',1)->get();
        $allcategory1 = Category::where('category_status',1)->get();
        return view('customer.cart.shopping_cart')->with(compact('allcategory1','allcategoryparent1','city','district','ward'));
    }
    public function addCart(Request $request)
    {

        $data = $request->all();
            $sizes = Attributes::where('product_id',$data['cart_product_id'])->get();
            $product = Attributes::where('product_id',$data['cart_product_id'])->first();
            $count = $sizes->count();
            $arraysize = array();
            $arraycolor = array();
            if($count>0){

                foreach ($sizes as $key => $value) {
                    array_push($arraysize, $value->size->size_name);
                };
                $arraysize = array_unique($arraysize);

                $colors = Attributes::where('product_id',$data['cart_product_id'])->get();

                foreach ($colors as $key => $value) {
                    array_push($arraycolor, $value->color->color_name);
                };
                $arraycolor = array_unique($arraycolor);
            }


            $session_id = substr(md5(microtime()),rand(0,26),5);
            $cart = session()->get('cart');
            if($cart==true){
                $is_avaiable = 0;
                foreach($cart as $key => $val){
                    if($val['product_id']==$data['cart_product_id']){
                        $is_avaiable++;
                        $cart[$key]['product_qty']+=$data['cart_product_qty'];
                        session()->put('cart', $cart);
                    }
                }
                if($is_avaiable == 0) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'arrsize' => $arraysize,
                        'arrcolor' => $arraycolor,
                        'size' => $product->size->size_name,
                        'color'=> $product->color->color_name,
                        'product_name' => $data['cart_product_name'],
                        'product_id' => $data['cart_product_id'],
                        'product_image' => $data['cart_product_image'],
                        'product_qty' => $data['cart_product_qty'],
                        'product_price' => $data['cart_product_price'],
                    );
                    session()->put('cart', $cart);
                }
            }else{
                $cart[] = array(
                    'session_id' => $session_id,
                    'arrsize'=> $arraysize,
                    'arrcolor'=> $arraycolor,
                    'size' => $product->size->size_name,
                    'color'=> $product->color->color_name,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                session()->put('cart',$cart);
            }

           session()->save();


    }
    public function addCartDetail(Request $request)
    {
        $data = $request->all();

        $colordetail = Color::where('color_name',$data['color'])->first();
        $sizedetail = Size::where('size_name',$data['size'])->first();
        $attrdetail = Attributes::where('product_id',$data['cart_product_id'])->where('color_id',$colordetail->color_id)->where('size_id',$sizedetail->size_id)->first();

        $quantityWareHourse = 0;
        if($attrdetail !=null){
            $quantityWareHourse = $attrdetail->quantity;

        }
        $sizes = Attributes::where('product_id',$data['cart_product_id'])->get();
        $count = $sizes->count();
        $arraycolor = array();
        $arraysize = array();

        if($data['cart_product_qty']>$quantityWareHourse || $count==0||$quantityWareHourse==0){
            echo "Lỗi";
        }else{
            foreach ($sizes as $key => $value) {
                array_push($arraysize, $value->size->size_name);
            };
            $arraysize = array_unique($arraysize);

            $colors = Attributes::where('product_id',$data['cart_product_id'])->get();

            foreach ($colors as $key => $value) {
                array_push($arraycolor, $value->color->color_name);
            };
            $arraycolor = array_unique($arraycolor);

            $session_id = substr(md5(microtime()),rand(0,26),5);
            $cart = session()->get('cart');
            if($cart==true){
                $is_avaiable = 0;
                foreach($cart as $key => $val){
                    if($val['product_id']==$data['cart_product_id']&& $val['size']==$sizedetail->size_name &&
                    $val['color']==$colordetail->color_name){
                        $is_avaiable++;
                        $cart[$key]['product_qty']+=$data['cart_product_qty'];
                        session()->put('cart', $cart);
                    }
                }
                if($is_avaiable == 0) {
                    $cart[] = array(
                        'session_id' => $session_id,
                        'arrsize' => $arraysize,
                        'arrcolor' => $arraycolor,
                        'size' => $sizedetail->size_name,
                        'color'=> $colordetail->color_name,
                        'product_name' => $data['cart_product_name'],
                        'product_id' => $data['cart_product_id'],
                        'product_image' => $data['cart_product_image'],
                        'product_qty' => $data['cart_product_qty'],
                        'product_price' => $data['cart_product_price'],
                    );
                    session()->put('cart', $cart);
                }
            }else{
                $cart[] = array(
                    'session_id' => $session_id,
                    'arrsize'=> $arraysize,
                    'arrcolor'=> $arraycolor,
                    'size' => $sizedetail->size_name,
                    'color'=> $colordetail->color_name,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                session()->put('cart',$cart);
            }

           session()->save();
        }


    }

    public function updateQuantityProduct(Request $request)
    {
        $data = $request->all();
        $cart = session()->get('cart');
        $qtyWareHouse=0;
        $i=0;
        if($cart==true){
                foreach($cart as $key => $value){
                                $size = Size::where('size_name',$data['size'])->first();
                                $color = Color::where('color_name',$data['color'])->first();
                                if($value['session_id']== $data['session_id']){
                                    $attr = Attributes::where('product_id',$value['product_id'])->where('size_id',$size->size_id)->where('color_id',$color->color_id)->first();
                                    if($attr){
                                        $qtyWareHouse = $attr->quantity;
                                        if($qtyWareHouse>=$data['valueNew']){
                                            $cart[$key]['product_qty'] = $data['valueNew'];
                                            $i = $i+1;
                                        }
                                    }
                                }
            }
        }
        if($i==1){
            session()->put('cart',$cart);
            echo "Cập nhật số lượng thành công";
        }else{
            echo "Số lượng sản phẩm trong kho nhỏ hơn số lượng sản phẩm bạn cần đặt";
        }

    }
    public function updateSizeCart(Request $request)
    {
        $data = $request->all();
        $cart = session()->get('cart');
        if($cart){
            foreach($cart as $key1 => $value1){
                if($value1['session_id'] == $data['session_id']){
                    $cart[$key1]['size'] = $data['size'];
                    $cart[$key1]['product_qty'] = 1;
                }
            }
            session()->put('cart',$cart);
        }
    }
    public function updateColorCart(Request $request)
    {
        $data = $request->all();
        $cart = session()->get('cart');
        if($cart){
            foreach($cart as $key1 => $value1){
                if($value1['session_id'] == $data['session_id']){
                    $cart[$key1]['color'] = $data['color'];
                    $cart[$key1]['product_qty'] = 1;
                }
            }
            session()->put('cart',$cart);
        }
    }
    public  function deleteCart($sessionId){
        $sessionCart = session()->get('cart');
        if($sessionCart == true){
            foreach($sessionCart as $key => $value){
                if($value['session_id']==$sessionId){
                    unset($sessionCart[$key]);
                }
            }
            session()->put('cart',$sessionCart);
            return redirect()->back()->with('message','Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('message','Xóa sản phẩm không thành công');
        }
    }
    public function countQuantityCart()
    {
        $count = 0;
        if(session()->get('cart')){
            $count = count(session()->get('cart'));
        }
        echo $count;
    }
    public function hoverCartProduct()
    {
        $html = '';
        $total = 0;
        $subtotal = 0;
        if(session()->get('cart')){
            foreach(session()->get('cart') as $value){
                $subtotal = $value['product_price'] *  $value['product_qty'];
                $total += $subtotal;
           $html .= '
           <div class="single-cart-box">
               <div class="cart-img">
                   <a href="#"><img src="'.asset('public/uploads/products/'.$value['product_image']).'" alt="cart-image"></a>
                   <span class="pro-quantity">'.$value['product_qty'].'X</span>
               </div>
               <div class="cart-content">
                   <h6><a href="product.html">'.$value['product_name'].'</a></h6>
                   <span class="cart-price">'.number_format($value['product_price'],0,',','.').'đ</span>
                   <span>Size: '.$value['size'].'</span>
                   <span>Màu: '.$value['color'].'</span>
               </div>
               <a class="del-icone" href="'.url('/home/cart/delete-cart/'.$value['session_id']).'"><i class="ion-close"></i></a>
           </div>
           ';}
           $html.='<div class="cart-footer">
           <ul class="price-content">
               <li>Tổng <span>'.number_format($total,0,',','.').'</span></li>
           </ul>
           <div class="cart-actions text-center">
               <a class="cart-checkout" href="'.url('/home/show-checkout').'">Thanh toán</a>
           </div>
       </div>';
        }else{
            $html .='<div class="text-center">Giỏ hàng trống</div>';
        }
        echo $html;

    }
    public function deleteAllCart(){
        $cart = \session()->get('cart');
        if($cart == true){
            \session()->forget('cart');
            \session()->forget('discount_code');
            \session()->forget('transport_fee_freeship');
            session()->forget('attributes');
            return redirect()->back()->with('message','Xóa giỏ hàng thành công');
        }
    }
    public function selectTransportFeeCustomer(Request $request){
        $data = $request->all();
        $html= '';
        if($data['action_change']){
            if($data['action_change']=="city"){
                $district = District::where('matp',$data['ma'])->orderBy('maqh','ASC')->get();
                $html.='<option value="0">--- Chọn quận, huyện ---</option>';
                foreach ($district as $key => $district){
                    $html.='<option value="'.$district->maqh.'">'.$district->nameqh.'</option>';
                }
            }else{
                $ward = Ward::where('maqh',$data['ma'])->orderBy('maxptt','ASC')->get();
                $html.='<option value="0">--- Chọn xã, phường, thị trấn ---</option>';
                foreach ($ward as $key => $ward){
                    $html.='<option value="'.$ward->maxptt.'">'.$ward->namexptt.'</option>';
                }
            }
        }
        echo  $html;
    }
    public function shippingChargesApply(Request $request){
        $data = $request->all();
        if($data['matp']){
            $transport_fee = TransportFee::where('matp', $data['matp'])->where('maqh', $data['maqh'])->where('maxptt', $data['maxptt'])->get();
            if($transport_fee){
                $count = count($transport_fee);
                if($count>0){
                    foreach($transport_fee as $key => $value){
                        session()->put('transport_fee_freeship',$value->transport_fee_freeship);
                        session()->save();
                    }
                }else{
                    session()->put('transport_fee_freeship',15000);
                    session()->save();
                }
            }
        }
    }
    public function deleteTransportFeeCustomer(){
        $sessionTransportFee = \session()->get('transport_fee_freeship');
        if($sessionTransportFee == true){
            \session()->forget('transport_fee_freeship');
            return redirect()->back()->with('message','Xóa phí vận chuyển thành công');
        }
    }

}
