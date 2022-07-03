<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Color;
use App\Models\Customer;
use App\Models\Discount_Code;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\Size;
use App\Models\Statistical;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StaffController extends Controller
{
    public function isLogin()
    {
        $staff = session()->get('staff_id');

        if($staff){
            return redirect()->to('/staff');
        }else{
            return redirect()->to(route('login'))->send();
        }
    }
    public function index()
    {
        $this->isLogin();
        return view('staff.staff_layout');
    }
    public function showManageOrder()
    {
        $this->isLogin();
        $order = Order::orderBy('order_id','DESC')->get();
        return view('staff.order.show_order')->with(compact('order'));
    }
    public function showOrderDetailStaff($orderCode)
    {
        $this->isLogin();
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

        return view('staff.order.show_order_detail')->with(compact('orderDetail','order',
        'discountCodeCondition','discountCodePrice','transportFee','quantityWareHouse'));
    }
    public function updateOrderStatusStaff(Request $request)
    {
        $this->isLogin();
        $data = $request->all();

        Order::where('order_id', $data['orderId'])->update(['order_status' => $data['orderStatus']]);

        $order = Order::find($data['orderId']);

        $orderDetail = OrderDetail::where('order_code',$order->order_code)->get();


        $statistical = Statistical::where('order_date',$order->order_date)->get();

        $discountCodeCondition = 0;
        $discountCodePrice = 0;
        $transportFee= 0;
        $discountCodeCode='Không có mã';

        $count = 0;

        if($statistical==true){
            $count = $statistical->count();
        }else{
            $count = 0;
        }
        $shipping = Shipping::where('shipping_id',$order->shipping_id)->first();

        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $title = 'Đơn hàng của bạn đã được giao vào ngày'.' '.$date;

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

        if($order->order_status == 2){
            $totalOrder = 0;
            $quantityStatistical = 0;
            $profit = 0;
            $sales = 0;
            $productPrice=0;
            foreach($data['productIdWashouse'] as $key => $value){
                foreach($data['color'] as $key1 => $color){
                    foreach($data['size'] as $key2 => $size){
                        if($key == $key1 && $key1 == $key2){
                            $colorValue = Color::where('color_name',$color)->first();
                            $sizeValue = Size::where('size_name',$size)->first();
                            $attr = Attributes::where('product_id', $value)->where('size_id',$sizeValue->size_id)->where('color_id',$colorValue->color_id)->first();
                            $qtyWareHouse = $attr->quantity;
                            $qtySold = $attr->quantity_sold;

                            $product = Product::find($value);

                            $productPrice = $product->product_price;

                            $productPriceCost = $product->product_price_cost;

                            $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                        }
                        foreach($data['quantity'] as $key3 => $quantityValue){
                            if($key == $key1 && $key1 == $key2 && $key2 == $key3){
                                $quantityStatistical = $quantityStatistical+ $quantityValue;
                                $totalOrder +=1;
                                $sales += $productPrice*$quantityValue;
                                $profit = $sales-($productPriceCost*$quantityValue);

                                $qtyWasHouseAfter = $qtyWareHouse - $quantityValue;
                                $attr->quantity = $qtyWasHouseAfter;
                                $attr->quantity_sold = $qtySold + $quantityValue;
                                $attr->save();

                            }
                        }
                    }
                }
            }
        Mail::send('admin.order.update_order',['orderListProduct'=>$orderListProduct,'arrayShipping'=>$arrayShipping,'codeOrder'=>$codeOrder],
        function($message) use ($title,$data){
            $message->to($data['email'])->subject($title);
            $message->from($data['email'],$title);
        });
            if($count>0){
                $statistical2 = Statistical::where('order_date',$order->order_date)->first();
                $statistical2->quantity = $statistical2->quantity + $quantityStatistical;
                $statistical2->profit = $statistical2->profit + $profit;
                $statistical2->sales = $statistical2->sales + $sales;
                $statistical2->total_order = $statistical2->total_order + $totalOrder;
                $statistical2->save();
            }else{
                $statisticalNew = new Statistical();
                $statisticalNew->order_date = $order->order_date;
                $statisticalNew->quantity = $quantityStatistical;
                $statisticalNew->profit = $profit;
                $statisticalNew->sales = $sales;
                $statisticalNew->total_order = $totalOrder;
                $statisticalNew->save();
            }
        }
    }

}
