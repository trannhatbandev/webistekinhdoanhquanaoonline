<?php

namespace App\Http\Controllers\Admin\Order;

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
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
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
    public function showListOrder(){
        $this->isLogin();
        $order = Order::orderBy('order_id','DESC')->get();
        return view('admin.order.show_order')->with(compact('order'));
    }
    public function showOrderDetail($orderCode)
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

        return view('admin.order.show_order_detail')->with(compact('orderDetail','order',
        'discountCodeCondition','discountCodePrice','transportFee','quantityWareHouse'));
    }
    public function updateOrderStatus(Request $request)
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
        // if($order->order_status != 2 && $order->order_status != 3){
        //     foreach($data['productIdWashouse'] as $key => $value){
        //         foreach($data['color'] as $key1 => $color){
        //             foreach($data['size'] as $key2 => $size){
        //                 if($key == $key1 && $key1 == $key2){
        //                     $colorValue = Color::where('color_name',$color)->first();
        //                     $sizeValue = Size::where('size_name',$size)->first();
        //                     $attr = Attributes::where('product_id', $value)->where('size_id',$sizeValue->size_id)->where('color_id',$colorValue->color_id)->first();
        //                     $qtyWareHouse = $attr->quantity;
        //                     $qtySold = $attr->quantity_sold;
        //                 }
        //                 foreach($data['quantity'] as $key3 => $quantityValue){
        //                     if($key2 == $key3){
        //                         $qtyWasHouseAfter = $qtyWareHouse + $quantityValue;

        //                         $attr->quantity = $qtyWasHouseAfter;
        //                         $attr->quantity_sold = $qtySold - $quantityValue;

        //                         $attr->save();
        //                     }

        //                 }
        //             }
        //         }
        //     }
        // }

    }
    public function exportPDF($orderCode)
    {
        $this->isLogin();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->printOrderPdf($orderCode));
        return $pdf->stream();
    }
    public function printOrderPdf($orderCode)
    {
        $this->isLogin();
        $orderDetail = OrderDetail::where('order_code',$orderCode)->get();

        foreach($orderDetail as $value){
            $discountCodeCode = $value->discount_code;
            $transportFee = $value->transport_fee;
        }

        $discountCode = Discount_Code::where('discount_code_code',$discountCodeCode)->first();

        if($discountCode){
            $count = $discountCode->count();
            if($count>0){
                $discountCodeCondition = $discountCode->discount_code_condition;
                $discountCodePrice = $discountCode->discount_code_price;
            }else{
                $discountCodeCondition = 0;
                $discountCodePrice = 0;
            }
        }
        $order = Order::where('order_code',$orderCode)->first();


        $html ='';

        $html.='<!DOCTYPE html>
        <html>
        <head>
        <style>
        body{
            font-family: DejaVu Sans;
        }
        table {
          border-collapse: collapse;
          width: 100%;
        }

        th, td {
          text-align: left;
          padding: 8px;
        }

        tr:nth-child(even) {background-color: #f2f2f2;}
        </style>
        </head>
        <body>

        <h2><center>Công ty TNB chuyên quần áo thời trang</center></h2>';
        $html.='
        <p><center>Thông tin khách hàng</center></p>
        <div style="overflow-x: auto;">
          <table>
            <tr>
              <th>Tên khách hàng</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
            </tr>';
            $html.='
            <tr>
              <td>'.$order->shipping->shipping_customer_name.'</td>
              <td>'.$order->shipping->shipping_customer_address.'</td>
              <td>'.$order->shipping->shipping_customer_phone.'</td>
            </tr>
          </table>
        </div>';

        $html.='
        <p><center>Thông tin đơn hàng</center></p>
        <div style="overflow-x: auto;">
          <table>
            <tr>
              <th>Sản phẩm</th>
              <th>Size</th>
              <th>Màu sắc</th>
              <th>Giá</th>
              <th>Số lượng</th>
              <th>Tổng tiền</th>
              <th>Mã khuyến mãi</th>
              <th>Phí vận chuyển</th>
              <th>Ngày đặt</th>
            </tr>';
            $subtotal = 0;
            $total = 0;
            $totalDiscounCode = 0;
            $totalAfter = 0;
            foreach($orderDetail as $value){
                $subtotal = $value->product_quantity* $value->product->product_price;
                $total+=$subtotal;
                $html.='
                <tr>
                  <td>'.$value->product->product_name.'</td>
                  <td>'.$value->size.'</td>
                  <td>'.$value->color.'</td>
                  <td>'.number_format($value->product->product_price,0,',','.').'đ</td>
                  <td>'.$value->product_quantity.'</td>
                  <td>'.$subtotal.'</td>
                  <td>'.$value->discount_code.'</td>
                  <td>'.number_format($value->transport_fee,0,',','.').'đ</td>
                  <td>'.$value->created_at.'</td>
                </tr>';
            }
            if($discountCodeCondition == 2){
                $totalDiscounCode = ($total * $discountCodePrice)/100;
                $totalAfter = $total- $totalDiscounCode;
            }else{
                $totalDiscounCode= $discountCodePrice;
                $totalAfter = $total- $totalDiscounCode;
            }
            $totalAfter += $transportFee ;
            $html.='
            <tr>
                <td><span>Tổng:</span></td>
                <td><span>'.number_format($total,0,',','.').'đ</span></td>
            </tr>
            <tr>
            <td><span>Khuyến mãi:</span></td>
            <td><span>'.$totalDiscounCode.'</span></td>
            </tr>
            <tr>
            <td><span>Phí vận chuyển:</span></td>
            <td><span>'.number_format($transportFee,0,',','.').'đ</span></td>
            </tr>
            <tr>
            <td><span>Thanh toán:</span></td>
            <td><span>'.number_format($totalAfter,0,',','.').'</span></td>
            </tr>
              </table>
            </div>';
        $html.='

        </body>
        </html>';

        return $html;
    }
}
