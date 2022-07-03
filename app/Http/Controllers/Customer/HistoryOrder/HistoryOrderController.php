<?php

namespace App\Http\Controllers\Customer\HistoryOrder;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Discount_Code;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Size;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HistoryOrderController extends Controller
{
    public function showHistoryOrder()
    {
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();

        $customer = Customer::where('customer_id',session()->get('customer_id'))->first();

        $shipping = Shipping::where('customer_id', $customer->customer_id)->get();

        $orderarr = [];
        foreach($shipping as $value){
            $order = Order::where('shipping_id',$value->shipping_id)->get();
            array_push( $orderarr,$order);
        }

        return view('customer.history_order')->with(compact('allcategory1', 'allcategoryparent1','orderarr'));
    }
    public function showHistoryOrderDetail($orderCode)
    {
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        $orderDetail = OrderDetail::where('order_code',$orderCode)->get();
        $discountCodeCondition = 0;
        $discountCodePrice = 0;

        foreach($orderDetail as $value){
            $discountCodeCode = $value->discount_code;
            $transportFee = $value->transport_fee;
            $size = Size::where('size_name',$value->size)->first();
            $color = Color::where('color_name',$value->color)->first();
            $quantyatrr = Attributes::where('product_id',$value->product_id)->where('size_id',$size->size_id)->where('color_id',$color->color_id)->first();
            $quantityPrdouct = $quantyatrr->quantity;
            $quantityWareHouse[] = array(
                'product_id'=> $value->product_id,
                'size' => $size->size_name,
                'color' => $color->color_name,
                'quantity' => $quantityPrdouct
            );
        }
        $discountCode = Discount_Code::where('discount_code_code',$discountCodeCode)->first();

        if($discountCode){
            $count = $discountCode->count();
            if($count>0){
                $discountCodeCondition = $discountCode->discount_code_condition;
                $discountCodePrice = $discountCode->discount_code_price;
            }
        }
        $order = Order::where('order_code',$orderCode)->first();

        return view('customer.history_order_detail')->with(compact('orderDetail','order',
        'discountCodeCondition','discountCodePrice','transportFee','quantityWareHouse','allcategory1', 'allcategoryparent1'));
    }
    public function cancelOrder($orderCode)
    {
        Order::where('order_code', $orderCode)->update(['order_status' => '3']);

        $discountCodeCondition = 0;
        $discountCodePrice = 0;
        $transportFee= 0;
        $discountCodeCode='Không có mã';

        $order = Order::where('order_code', $orderCode)->first();

        $orderDetail = OrderDetail::where('order_code',$orderCode)->get();

        $shipping = Shipping::where('shipping_id',$order->shipping_id)->first();

        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $title = 'Đơn hàng của bạn vào ngày'.' '.$date.' đã được hủy thành công';

        $customer = Customer::where('customer_id',$shipping->customer_id)->first();

        $data['email'][] = $customer->customer_email;

        foreach($orderDetail as $value){
            $discountCodeCode = $value->discount_code;
            $transportFee = $value->transport_fee;
            $size = Size::where('size_name',$value->size)->first();
            $color = Color::where('color_name',$value->color)->first();
            $product = Product::where('product_id',$value->product_id)->first();
            $orderListProduct[] = array(
                'product_name'=> $product->product_name,
                'product_price'=> $product->product_price,
                'size' => $size->size_name,
                'color' => $color->color_name,
                'product_qty' => $value->product_quantity
            );
        }
        $discountCode = Discount_Code::where('discount_code_code',$discountCodeCode)->first();

        if($discountCode==true){
            $count = $discountCode->count();
            if($count>0){
                $discountCodeCondition = $discountCode->discount_code_condition;
                $discountCodePrice = $discountCode->discount_code_price;
            }
        }
        $arrayShipping = array(
            'shipping_customer_name' => $shipping->shipping_customer_name,
            'shipping_customer_address' => $shipping->shipping_customer_address,
            'shipping_customer_phone' => $shipping->shipping_customer_phone,
        );

        $codeOrder = array(
            'transport_fee'=> $transportFee,
            'discount_code' => $discountCodeCode,
            'discount_code_price' => $discountCodePrice,
            'discount_code_condition' => $discountCodeCondition,
            'order_code' => $order->order_code,
        );
        Mail::send('customer.mail_cancel_order',['orderListProduct'=>$orderListProduct,'arrayShipping'=>$arrayShipping,'codeOrder'=>$codeOrder],
        function($message) use ($title,$data){
            $message->to($data['email'])->subject($title);
            $message->from($data['email'],$title);
        });
        Toastr::success('Hủy đơn hàng thành công','Thành công');

        return redirect()->back();
    }
    public function countOrder()
    {
        $customer = Customer::where('customer_id',session()->get('customer_id'))->first();

        $shipping = Shipping::where('customer_id', $customer->customer_id)->get();

        $orderarr = [];
        $count = 0;
        foreach($shipping as $value){
            $order = Order::where('shipping_id',$value->shipping_id)->get();
            $count = count($order)+ $count;
            array_push( $orderarr,$order);
        }
        echo 'Đơn hàng('.$count.')';
    }
}
