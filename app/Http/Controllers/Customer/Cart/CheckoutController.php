<?php

namespace App\Http\Controllers\Customer\Cart;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use App\Models\Category;
use App\Models\City;
use App\Models\Color;
use App\Models\Customer;
use App\Models\CustomerDiscountCode;
use App\Models\Discount_Code;
use App\Models\momo;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Size;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function showCheckout(){
        $city = City::orderBy('matp','ASC')->get();
        $shipping = Shipping::where('customer_id',session()->get('customer_id'))->get();
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.cart.show_checkout')->with(compact('city','shipping','allcategory1', 'allcategoryparent1'));
    }
    public function showCheckoutSucess()
    {
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        $transport_fee = 0;
        $discount_code  = 'Không có mã';
        $discount_code_price = 0;
        $discount_code_condition= '';
        $countmail = 0;
        if(isset($_GET['partnerCode'])&& $countmail == 0 && session()->get('cart')){
        $shipping = Shipping::where('customer_id',session()->get('customer_id'))->where('shipping_default',1)->first();
                $shipping_id = $shipping->shipping_id;
                $momo = new momo();
                $momo->partnerCode = $_GET['partnerCode'];
                $momo->orderId = $_GET['orderId'];
                $momo->amount = $_GET['amount'];
                $momo->orderInfo = $_GET['orderInfo'];
                $momo->transId = $_GET['transId'];
                $momo->message = $_GET['message'];
                $momo->payType = $_GET['payType'];
                $momo->save();

                $payment =  new Payment();
                $payment->payment_method = "Thanh toán MoMO ATM";
                $payment->cart_payment =$momo->momo_id;
                $payment->save();

                $order_code = substr(md5(microtime()),rand(0,26),5);

                $order = new Order();
                $order->order_code = $order_code;
                $order->shipping_id = $shipping_id;
                $order->payment_id = $payment->payment_id;
                $order->order_status = 1;
                $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
                $order->order_date = $order_date;
                $order->save();

                if(session()->get('transport_fee_freeship')){
                    $transport_fee = session()->get('transport_fee_freeship');
                }else{
                    $transport_fee = 0;
                }

                if(session()->get('discount_code')){
                    foreach(session()->get('discount_code') as $value){
                        $discount_code = $value['discount_code_code'];
                        $discount_code_price  = $value['discount_code_price'];
                        $discount_code_condition  = $value['discount_code_condition'];

                        $discountCode = Discount_Code::where('discount_code_code',$value['discount_code_code'])->first();

                        $discountCode->discount_code_quantity = $value['discount_code_quantity']-1;
                        $discountCode->save();

                        $cusDiscountCode = CustomerDiscountCode::where('discount_code_id',$discountCode->discount_code_id)->where('customer_id',session()->get('customer_id'))->first();
                        if($cusDiscountCode==false){
                            $cusDiscountCodeNew = new CustomerDiscountCode();
                            $cusDiscountCodeNew->customer_id = session()->get('customer_id');
                            $cusDiscountCodeNew->discount_code_id = $discountCode->discount_code_id;
                            $cusDiscountCodeNew->save();
                        }
                    }
                }else{
                    $discount_code  = 'Không có mã';

                }
                foreach (session()->get('cart') as $key => $value)
                {
                            $orderDetail = new OrderDetail();
                            $orderDetail->order_code = $order_code;
                            $orderDetail->product_id = $value['product_id'];
                            $orderDetail->product_quantity = $value['product_qty'];
                            $orderDetail->size = $value['size'];
                            $orderDetail->color = $value['color'];
                            $orderDetail->discount_code = $discount_code;
                            $orderDetail->transport_fee = $transport_fee;
                            $orderDetail->save();
                }
                $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

                $title = 'Đơn hàng đã được xác nhận vào ngày'.' '.$date;

                $customer = Customer::find(session()->get('customer_id'));

                $data['email'][] = $customer->customer_email;

                if(session()->get('cart')){
                    foreach(session()->get('cart') as $cartOrder){
                        $arrayCartOrder[] = array(
                            'product_name' => $cartOrder['product_name'],
                            'product_price' => $cartOrder['product_price'],
                            'product_qty' => $cartOrder['product_qty'],
                        );
                    }
                }

                $arrayShipping = array(
                    'shipping_customer_name' => $shipping->shipping_customer_name,
                    'shipping_customer_address' => $shipping->shipping_customer_address,
                    'shipping_customer_phone' => $shipping->shipping_customer_phone,
                );

                $codeOrder = array(
                    'transport_fee'=> $transport_fee,
                    'discount_code' => $discount_code,
                    'discount_code_price' => $discount_code_price,
                    'discount_code_condition' => $discount_code_condition,
                    'order_code' => $order_code,
                );


                Mail::send('customer.mail_order',['payment_method'=>"Thanh toán MoMO ATM",'arrayCartOrder'=>$arrayCartOrder,'arrayShipping'=>$arrayShipping,'codeOrder'=>$codeOrder],
                function($message) use ($title,$data){
                    $message->to($data['email'])->subject($title);
                    $message->from($data['email'],$title);
                });

                session()->forget('cart');
                session()->forget('attributes');
                if(session()->get('transport_fee_freeship')){
                    session()->forget('transport_fee_freeship');
                }
                if(session()->get('discount_code')){
                    session()->forget('discount_code');
                }
                $countmail = $countmail + 1;
            }

        return view('customer.cart.show_checkout_success')->with(compact('allcategory1', 'allcategoryparent1'));
    }
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function momoCheckout(Request $request)
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";


        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = ceil($request->momo_total);
        $orderId = time() . "";
        $redirectUrl = "http://localhost/copy1/backend/luanvantotnghiep/home/show-checkout-success";
        $ipnUrl = "http://localhost/copy1/backend/luanvantotnghiep/home/show-checkout-success";
        $extraData = "";


            $requestId = time() . "";
            $requestType = "payWithATM";
//            $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "SHOP TNB",
                "storeId" => "SHOP TNB",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            return redirect()->to($jsonResult['payUrl']);
    }
    public function offLineCheckout(Request $request){
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        $transport_fee = 0;
        $discount_code  = 'Không có mã';
        $discount_code_price = 0;
        $discount_code_condition= '';
        if(session()->get('customer_id')!=null && session()->get('address_shipping')){
            $shipping = Shipping::where('shipping_id',session()->get('shipping_id'))->where('shipping_default',1)->first();
            $shipping_id = $shipping->shipping_id;

            $payment = new Payment();
            $payment->payment_method = "Thanh toán Trực tiếp";
            $payment->cart_payment =0;
            $payment->save();

            $order_code = substr(md5(microtime()),rand(0,26),5);

            $order = new Order();
            $order->order_code = $order_code;
            $order->shipping_id = $shipping_id;
            $order->payment_id = $payment->payment_id;
            $order->order_status = 1;
            $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $order->order_date = $order_date;
            $order->save();

            if(session()->get('transport_fee_freeship')){
                $transport_fee = session()->get('transport_fee_freeship');
            }else{
                $transport_fee = 0;
            }
            if(session()->get('discount_code')){
                foreach(session()->get('discount_code') as $value){
                    $discount_code = $value['discount_code_code'];
                    $discount_code_price  = $value['discount_code_price'];
                    $discount_code_condition  = $value['discount_code_condition'];

                    $discountCode = Discount_Code::where('discount_code_code',$value['discount_code_code'])->first();

                    $discountCode->discount_code_quantity = $value['discount_code_quantity']-1;
                    $discountCode->save();


                        $cusDiscountCode = CustomerDiscountCode::where('discount_code_id',$discountCode->discount_code_id)
                        ->where('customer_id',session()->get('customer_id'))->first();
                        if($cusDiscountCode==false){
                            $cusDiscountCodeNew = new CustomerDiscountCode();
                            $cusDiscountCodeNew->customer_id = session()->get('customer_id');
                            $cusDiscountCodeNew->discount_code_id = $discountCode->discount_code_id;
                            $cusDiscountCodeNew->save();
                        }


                }
            }else{
                $discount_code  = 'Không có mã';

            }
            foreach (session()->get('cart') as $key => $value)
            {
                        $orderDetail = new OrderDetail();
                        $orderDetail->order_code = $order_code;
                        $orderDetail->product_id = $value['product_id'];
                        $orderDetail->product_quantity = $value['product_qty'];
                        $orderDetail->size = $value['size'];
                        $orderDetail->color = $value['color'];
                        $orderDetail->discount_code = $discount_code;
                        $orderDetail->transport_fee = $transport_fee;
                        $orderDetail->save();
            }
            $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

            $title = 'Đơn hàng đã được xác nhận vào ngày'.' '.$date;

            $customer = Customer::find(session()->get('customer_id'));

            $data['email'][] = $customer->customer_email;

            if(session()->get('cart')){
                foreach(session()->get('cart') as $cartOrder){
                    $arrayCartOrder[] = array(
                        'product_name' => $cartOrder['product_name'],
                        'product_price' => $cartOrder['product_price'],
                        'product_qty' => $cartOrder['product_qty'],
                    );
                }
            }

            $arrayShipping = array(
                'shipping_customer_name' => $shipping->shipping_customer_name,
                'shipping_customer_address' => $shipping->shipping_customer_address,
                'shipping_customer_phone' => $shipping->shipping_customer_phone,
            );

            $codeOrder = array(
                'transport_fee'=> $transport_fee,
                'discount_code' => $discount_code,
                'discount_code_price' => $discount_code_price,
                'discount_code_condition' => $discount_code_condition,
                'order_code' => $order_code,
            );


            Mail::send('customer.mail_order',['payment_method'=>"Thanh toán Trực tiếp",'arrayCartOrder'=>$arrayCartOrder,'arrayShipping'=>$arrayShipping,'codeOrder'=>$codeOrder],
            function($message) use ($title,$data){
                $message->to($data['email'])->subject($title);
                $message->from($data['email'],$title);
            });

            session()->forget('cart');
            session()->forget('attributes');
            if(session()->get('transport_fee_freeship')){
                session()->forget('transport_fee_freeship');
            }
            if(session()->get('discount_code')){
                session()->forget('discount_code');
            }
            return view('customer.cart.show_checkout_success')->with(compact('allcategory1', 'allcategoryparent1'));
        }else{
            return redirect()->back()->with('message','Bạn phải thêm địa chỉ vận chuyển');
        }

    }

}
