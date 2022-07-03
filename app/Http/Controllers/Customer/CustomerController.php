<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Shipping;
use App\Models\Social;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use App\Models\Customer;
use App\Models\CustomerDiscountCode;
use App\Models\Discount_Code;
use App\Models\District;
use App\Models\TransportFee;
use App\Models\Ward;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class CustomerController extends Controller
{
    public function showPersonalInformation()
    {
        $customer = Customer::where('customer_id',session()->get('customer_id'))->first();
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.show_info_customer')->with(compact('customer','allcategory1', 'allcategoryparent1'));
    }
    public function changeInfoCustomer(Request $request,$id)
    {
        $data = Validator::make($request->all(), [
            'customer_email' => ['required', 'email:filter', 'max:100'],
            'customer_full_name' => ['required', 'max:255', 'string'],
            'customer_phone' => ['required', 'min:10', 'numeric'],
        ], [
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            'customer_email.unique' => 'Email này đã có! Vui lòng nhập email khác',
            'customer_email.max' => 'Email tối đa là 100 kí tự',
            'customer_full_name.required' => 'Vui lòng nhập họ và tên',
            'customer_full_name.max' => 'Họ và tên tối đa là 255 kí tự',
            'customer_full_name.string' => 'Vui lòng nhập chữ',
            'customer_address.max' => 'Địa chỉ tối đa 255 kí tự',
            'customer_phone.required' => 'Số điện thoại chưa điền',
            'customer_phone.min' => 'Số điện thoại tối thiểu 10 kí tự',
            'customer_phone.numeric' => 'Số điện thoại phải là kí tự số',
        ])->validate();

        $customer = Customer::find($id);

        $customer->customer_full_name =  $data['customer_full_name'];
        $customer->customer_email =  $data['customer_email'];
        $customer->customer_phone =  $data['customer_phone'];

        $customer->save();

        return \redirect()->back()->with('message','Lưu thông tin thành công');
    }
    public function showChangeAddress()
    {
        $city = City::orderBy('matp','ASC')->get();
        $customer = Customer::where('customer_id',session()->get('customer_id'))->first();
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.show_address_customer')->with(compact('city','customer','allcategory1', 'allcategoryparent1'));
    }
    public function changeAddressUpdate(Request $request,$id)
    {
        $data = Validator::make($request->all(), [
            'customer_address' => ['required', 'max:255'],
            'city'=>['required'],
            'district'=>['required'],
            'ward'=>['required']
        ], [
            'customer_address.required' => 'Địa chỉ chưa điền',
            'city.required' => 'Tỉnh chưa chọn',
            'district.required' => 'Huyện chưa chọn',
            'ward.required' => 'Xã chưa chọn',
            'customer_address.max' => 'Địa chỉ tối đa 255 kí tự',
        ])->validate();

        $ward = Ward::where('maxptt',$data['ward'])->first();
        $district = District::where('maqh',$data['district'])->first();
        $city = City::where('matp',$data['city'])->first();

        $customer = Customer::find($id);
        $customer->customer_address = $data['customer_address'].','.$ward->namexptt.','.$district->nameqh.','.$city->nametp;
        $customer->save();
        return \redirect()->back()->with('message','Lưu thông tin thành công');
    }
    public function showChangePasswordCustomer()
    {
        $customer = Customer::where('customer_id',session()->get('customer_id'))->first();
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.show_change_password')->with(compact('customer','allcategory1', 'allcategoryparent1'));
    }
    public function changePasswordCustomerUpdate(Request $request,$id)
    {
        $data = Validator::make($request->all(), [
            'customer_password' => ['required', 'max:100', Password::min(8)->letters()->mixedCase()->symbols()->numbers()->uncompromised()],
            'customer_current_password' => ['required', 'max:100', 'same:customer_password'],
        ], [
            'customer_password.required' => 'Vui lòng nhập mật khẩu',
            'customer_password.max' => 'Mật khẩu tối đa là 100 kí tự',
            'customer_password.min' => 'Mật khẩu tối thiểu là 8 kí tự',
            'customer_current_password.required' => 'Nhập lại mật khẩu chưa điền',
            'customer_current_password.max' => 'Nhập lại mật khẩu tối đa 100 kí tự',
            'customer_current_password.same' => 'Nhập lại mật khẩu không giống mật khẩu',
        ])->validate();

        $customer = Customer::find($id);
        $customer->customer_password = $data['customer_password'];
        $customer->save();
        return \redirect()->back()->with('message','Lưu thông tin thành công');

    }
    public function showAllDiscountCodeCustomer()
    {
        $discountcode = Discount_Code::all();
        $customer = Customer::where('customer_id',session()->get('customer_id'))->first();
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.show_all_discount_code_customer')->with(compact('discountcode','customer','allcategory1', 'allcategoryparent1'));
    }
    public function showRegisterCustomer()
    {
        $city = City::orderBy('matp','ASC')->get();
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.customer_register')->with(compact('city','allcategory1', 'allcategoryparent1'));
    }
    public function customerAddAddressShipping(Request $request)
    {
        $data = Validator::make($request->all(), [
            'shipping_customer_name' => ['required', 'max:255', 'string'],
            'shipping_customer_address' => ['required', 'max:255'],
            'shipping_customer_phone' => ['required', 'min:10', 'numeric'],
            'city'=>['required'],
            'district'=>['required'],
            'ward'=>['required']
        ], [
            'shipping_customer_name.required' => 'Vui lòng nhập họ và tên',
            'shipping_customer_name.max' => 'Họ và tên tối đa là 255 kí tự',
            'shipping_customer_name.string' => 'Vui lòng nhập chữ',
            'shipping_customer_address.required' => 'Địa chỉ chưa điền',
            'shipping_customer_phone.required' => 'Số điện thoại phải điền',
            'shipping_customer_phone.min' => 'Số điện thoại tối thiểu 10 số',
            'shipping_customer_phone.numeric' => 'Số điện thoại phải là số',
            'city.required' => 'Tỉnh chưa chọn',
            'district.required' => 'Huyện chưa chọn',
            'ward.required' => 'Xã chưa chọn',
            'shipping_customer_address.max' => 'Địa chỉ tối đa 255 kí tự',
        ])->validate();

        $ward = Ward::where('maxptt',$data['ward'])->first();
        $district = District::where('maqh',$data['district'])->first();
        $city = City::where('matp',$data['city'])->first();

        $shipping = new Shipping();

        $shipping->shipping_customer_name = $data['shipping_customer_name'];
        $shipping->shipping_customer_address = $data['shipping_customer_address'].','.$ward->namexptt.','.$district->nameqh.','.$city->nametp;
        $shipping->shipping_customer_phone = $data['shipping_customer_phone'];
        $shipping->customer_id = session()->get('customer_id');
        $shipping->matp = $data['city'];
        $shipping->maqh = $data['district'];
        $shipping->maxptt = $data['ward'];
        $shipping->shipping_default = 0;
        $shipping->save();

        Toastr::success("Thêm địa chỉ thành công", "Thành công");
        // session()->put('address_shipping',$shipping->shipping_customer_address);
        // session()->put('shipping_id',$shipping->shipping_id);
        return redirect()->back();
    }
    public function changeAddressCustomer(Request $request)
    {
        $data = $request->all();
        Shipping::where('shipping_id', $data['id'])->update(['shipping_default' => 1]);
        Shipping::where('shipping_default',1)->where('shipping_id','<>',$data['id'])->update(['shipping_default' => 0]);
        $shipping = Shipping::where('shipping_id',$data['id'])->where('shipping_default',1)->first();
        $transportFee = TransportFee::where('matp',$shipping->matp)->where('maqh',$shipping->maqh)->where('maxptt',$shipping->maxptt)->get();
        if($transportFee){
            $count = count($transportFee);
            if($count>0){
                foreach($transportFee as $value){
                    session()->put('transport_fee_freeship',$value->transport_fee_freeship);
                    session()->save();
                }
            }else{
                session()->put('transport_fee_freeship',15000);
                session()->save();
            }
        }
        session()->put('address_shipping',$shipping->shipping_customer_address);
        session()->put('shipping_id',$shipping->shipping_id);
        session()->save();
    }

    public function registerCustomer(Request $request)
    {
        $data = Validator::make($request->all(), [
            'customer_email' => ['required', 'email', 'unique:customer', 'max:100'],
            'customer_full_name' => ['required', 'max:255', 'string'],
            'customer_password' => ['required', 'max:100', Password::min(8)->letters()->mixedCase()->symbols()->numbers()->uncompromised()],
            'customer_current_password' => ['required', 'max:100', 'same:customer_password'],
            'customer_address' => ['required', 'max:255'],
            'customer_phone' => ['required', 'min:10', 'numeric'],
            'city'=>['required'],
            'district'=>['required'],
            'ward'=>['required']
        ], [
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            'customer_email.unique' => 'Email này đã có! Vui lòng nhập email khác',
            'customer_email.max' => 'Email tối đa là 100 kí tự',
            'customer_full_name.required' => 'Vui lòng nhập họ và tên',
            'customer_full_name.max' => 'Họ và tên tối đa là 255 kí tự',
            'customer_full_name.string' => 'Vui lòng nhập chữ',
            'customer_password.required' => 'Vui lòng nhập mật khẩu',
            'customer_password.max' => 'Mật khẩu tối đa là 100 kí tự',
            'customer_password.min' => 'Mật khẩu tối thiểu là 8 kí tự',
            'customer_current_password.required' => 'Nhập lại mật khẩu chưa điền',
            'customer_current_password.max' => 'Nhập lại mật khẩu tối đa 100 kí tự',
            'customer_current_password.same' => 'Nhập lại mật khẩu không giống mật khẩu',
            'customer_address.required' => 'Địa chỉ chưa điền',
            'city.required' => 'Tỉnh chưa chọn',
            'district.required' => 'Huyện chưa chọn',
            'ward.required' => 'Xã chưa chọn',

            'customer_address.max' => 'Địa chỉ tối đa 255 kí tự',
            'customer_phone.required' => 'Số điện thoại chưa điền',
            'customer_phone.min' => 'Số điện thoại tối thiểu 10 kí tự',
            'customer_phone.numeric' => 'Số điện thoại phải là kí tự số',
        ])->validate();
        // $email = $data['customer_email'];
        // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //     return;
        // }
        $customer = new Customer();

        $ward = Ward::where('maxptt',$data['ward'])->first();
        $district = District::where('maqh',$data['district'])->first();
        $city = City::where('matp',$data['city'])->first();

        $customer->customer_email = $data['customer_email'];
        $customer->customer_full_name = $data['customer_full_name'];
        $customer->customer_password =  md5($data['customer_password']);
        $customer->customer_address = $data['customer_address'].','.$ward->namexptt.','.$district->nameqh.','.$city->nametp;
        $customer->customer_phone = $data['customer_phone'];
        $customer->customer_vip = 1;
        $token = Str::random();
        $customer->customer_token = $token;
        $customer->save();

        $shipping = new Shipping();

        $shipping->shipping_customer_name = $data['customer_full_name'];
        $shipping->shipping_customer_address = $data['customer_address'].','.$ward->namexptt.','.$district->nameqh.','.$city->nametp;
        $shipping->shipping_customer_phone = $data['customer_phone'];
        $shipping->matp = $data['city'];
        $shipping->maqh = $data['district'];
        $shipping->maxptt = $data['ward'];
        $shipping->customer_id = $customer->customer_id;
        $shipping->shipping_default = 1;


        $shipping->save();

        $date_now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $mail_title = "Xác nhận email để đăng ký tài khoản trên webiste của chúng tôi vào ngày: ".''.$date_now;

        $to_email = $data['customer_email'];
        $link_recover_password = url('/home/show-confirm-email?email='.$to_email.'&token='.$token);

        $data = array("name"=>$mail_title,"body"=>$link_recover_password,'email'=>$data['customer_email']);

        Mail::send('customer.confirm_email_notify',['data'=>$data],function ($message) use ($mail_title,$data){
            $message->to($data['email'])->subject($mail_title);
            $message->from($data['email'],$mail_title);
        });

        return \redirect()->back()->with('message','Đăng ký thành công vui lòng vào email để xác nhận');

    }
    public function registerSuccess(Request $request){
        $data = $request->all();
        $customer = Customer::where('customer_email',$data['email'])->first();
        $shipping = Shipping::where('customer_id',$customer->customer_id)->first();
        $transportFee = TransportFee::where('matp',$shipping->matp)->where('maqh',$shipping->maqh)->where('maxptt',$shipping->maxptt)->get();
        if($transportFee){
            $count = count($transportFee);
            if($count>0){
                foreach($transportFee as $value){
                    session()->put('transport_fee_freeship',$value->transport_fee_freeship);
                    session()->save();
                }
            }else{
                session()->put('transport_fee_freeship',15000);
                session()->save();
            }
        }
        session()->put('shipping_id',$shipping->shipping_id);
        session()->put('address_shipping',$shipping->shipping_customer_address);

        session()->put('customer_name',$customer->customer_full_name);
        session()->put('customer_id',$customer->customer_id);

        return Redirect::to("/");
    }
    public function showConfirmEmail(){
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.show_confirm_email')->with(compact('allcategory1', 'allcategoryparent1'));
    }
    public function showLoginCustomer(){
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.customer_login')->with(compact('allcategory1', 'allcategoryparent1'));
    }
    public function loginCustomer(Request $request){
        $data = Validator::make($request->all(), [
            'customer_email' => ['required', 'email:filter', 'max:100'],
            'customer_password' => ['required', 'max:100', Password::min(8)->letters()->mixedCase()->symbols()->numbers()->uncompromised()],
        ], [
            'customer_email.required' => 'Vui lòng nhập email',
            'customer_email.email' => 'Vui lòng nhập đúng định dạng email',
            'customer_email.max' => 'Email tối đa là 100 kí tự',
            'customer_password.required' => 'Vui lòng nhập mật khẩu',
            'customer_password.max' => 'Mật khẩu tối đa là 100 kí tự',
            'customer_password.min' => 'Mật khẩu tối thiểu là 8 kí tự',
        ])->validate();
        $email = $data['customer_email'];
        $password = md5($data['customer_password']);
        $customer = Customer::where('customer_email',$email)->where('customer_password',$password)->first();
        $shipping = Shipping::where('customer_id',$customer->customer_id)->where('shipping_default',1)->first();
        $transportFee = TransportFee::where('matp',$shipping->matp)->where('maqh',$shipping->maqh)->where('maxptt',$shipping->maxptt)->get();
        if($transportFee){
            $count = count($transportFee);
            if($count>0){
                foreach($transportFee as $value){
                    session()->put('transport_fee_freeship',$value->transport_fee_freeship);
                    session()->save();
                }
            }else{
                session()->put('transport_fee_freeship',15000);
                session()->save();
            }
        }
        if($customer){
            session()->put('customer_name',$customer->customer_full_name);
            session()->put('customer_id',$customer->customer_id);
            session()->put('address_shipping',$shipping->shipping_customer_address);
            session()->put('shipping_id',$shipping->shipping_id);


            if(session()->get('discount_code')){
                foreach(session()->get('discount_code') as $value){
                    $discountCode = Discount_Code::where('discount_code_code',$value['discount_code_code'])->first();

                    $cusDiscountCode = CustomerDiscountCode::where('discount_code_id',$discountCode->discount_code_id)->where('customer_id',session()->get('customer_id'))->first();

                    if($cusDiscountCode){
                        session()->forget('discount_code');
                        return Redirect::to("/home/cart/show-cart")->with('login','Bạn đã nhập mã khuyến mãi này một lần xin sử dụng tài khoản khác!');
                    }else{
                        return Redirect::to("/home/cart/show-cart");
                    }
                }
            }
            Toastr::success("Đăng nhập thành công", "Thành công");
            return Redirect::to("/");
        }else{
            return redirect()->back()->with('login','Bạn đăng nhập không thành công!');
        }

    }
    public function logoutCustomer(){
        session()->put('customer_name',null);
        session()->put('customer_id',null);
        session()->put('customer_address',null);
        return Redirect::to("/");
    }

    public function showForgetPassword(){
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.show_forget_password')->with(compact('allcategory1', 'allcategoryparent1'));
    }
    public function recoverPassword(Request $request){
        $data = $request->all();

        $date_now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $mail_title = "Lấy lại mật khẩu của bạn ngày: ".''.$date_now;
        $customer = Customer::where('customer_email',$data['customer_email'])->get();
        foreach($customer as $key => $value){
            $customer_id = $value->customer_id;
        }

        if($customer){
            $count = $customer->count();
            if($count ==0){
                return \redirect()->back()->with('login','Email chưa được đăng ký để lấy lại mật khẩu');
            }else{
                $token = Str::random();
                $customerfind = Customer::find($customer_id);
                $customerfind->customer_token = $token;
                $customerfind->save();

                $to_email = $data['customer_email'];
                $link_recover_password = url('/home/show-recover-new-password?email='.$to_email.'&token='.$token);

                $data = array("name"=>$mail_title,"body"=>$link_recover_password,'email'=>$data['customer_email']);

                Mail::send('customer.recover_password_notify',['data'=>$data],function ($message) use ($mail_title,$data){
                   $message->to($data['email'])->subject($mail_title);
                   $message->from($data['email'],$mail_title);
                });

                return \redirect()->back()->with('message','Gửi mail thành công, vui lòng vào email để lấy lại mật khẩu');
            }
        }
    }
    public function showRecoverNewPassword(){
        $allcategoryparent1 = Category::where('category_status', 1)->get();
        $allcategory1 = Category::where('category_status', 1)->get();
        return view('customer.recover_new_password')->with(compact('allcategory1', 'allcategoryparent1'));
    }
    public function recoverNewPassword(Request $request){
        $data = Validator::make($request->all(), [
            'email'=>'required',
            'token'=>'required',
            'customer_password' => ['required', 'max:100', Password::min(8)->letters()->mixedCase()->symbols()->numbers()->uncompromised()],
            'customer_current_password' => ['required', 'max:100', 'same:customer_password'],
        ], [
            'customer_password.required' => 'Vui lòng nhập mật khẩu',
            'customer_password.max' => 'Mật khẩu tối đa là 100 kí tự',
            'customer_password.min' => 'Mật khẩu tối thiểu là 8 kí tự',
            'customer_current_password.required' => 'Nhập lại mật khẩu chưa điền',
            'customer_current_password.max' => 'Nhập lại mật khẩu tối đa 100 kí tự',
            'customer_current_password.same' => 'Nhập lại mật khẩu không giống mật khẩu',

        ])->validate();
        $token = Str::random();
        $customer = Customer::where('customer_email',$data['email'])->where('customer_token',$data['token'])->get();
        $count_customer = $customer->count();
        if($count_customer>0){
            foreach ($customer as $key => $value){
                $customer_id = $value->customer_id;
            }
            $customer_find = Customer::find($customer_id);
            $customer_find->customer_password = md5($data['customer_password']);
            $customer_find->customer_token = $token;
            $customer_find->save();
            return \redirect('/home/logout-customer')->with('message','Mật khẩu đã được cập nhật thành công');
        }else{
            return \redirect('/home/show-forget-password')->with('login','Vui lòng lấy lại link vì kink đã quá hạn');
        }
    }
    public function googleLogin(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle(){

        $customers = Socialite::driver('google')->stateless()->user();
        $authenCustomer = $this->findOrCreateCustomerGoogle($customers,'google');

        if($authenCustomer){
            $account = Customer::where('customer_id', $authenCustomer->user_id)->first();
            session()->put('customer_name', $account->customer_full_name);
            session()->put('customer_id', $account->customer_id);
        }elseif($customernew){
            $account = Customer::where('customer_id', $authenCustomer->user_id)->first();
            session()->put('customer_name', $account->customer_full_name);
            session()->put('customer_id', $account->customer_id);
        }


        return \redirect('/')->with('message','Đăng nhập tài khoản google thành công');
    }
    public function findOrCreateCustomerGoogle($customers,$provider){
        $authenCustomer = Social::where('provider_user',$customers->id)->first();
        if($authenCustomer){
            return $authenCustomer;
        }else{
            $customernew = new Social([
                'provider_user' => $customers->id,
                'provider' => $provider
            ]);
            $compare = Customer::where('customer_email',$customers->email)->first();
            if(!$compare){
                $compare = Customer::create([
                    'customer_full_name'=>$customers->name,
                    'customer_email'=>$customers->email,
                    'customer_password'=>'',
                    'customer_phone'=>'',
                    'customer_address'=>'',
                    'customer_vip'=>1,
                ]);
            }
            $customernew->login()->associate($compare);
            $customernew->save();

            return $customernew;
        }


    }
    public function facebookLogin(){
        return Socialite::driver('facebook')->redirect();
    }
    public function callbackFacebook(){
        $customer = Socialite::driver('facebook')->user();

        $account_customer = Social::where('provider','facebook')->where('provider_user',$customer->getId())->first();

        if($account_customer){
            $name = Customer::where('customer_id', $account_customer->user_id)->first();
            session()->put('customer_name', $name->customer_full_name);
            session()->put('customer_id', $name->customer_id);
            return \redirect('/')->with('message','Đăng nhập tài khoản facebook thành công');
        }else{
            $customernew = new Social([
                'provider_user' => $customer->id,
                'provider' => 'facebook'
            ]);
            $compare = Customer::where('customer_email',$customer->getEmail())->first();
            if(!$compare){
                $compare = Customer::create([
                    'customer_full_name'=>$customer->getName(),
                    'customer_email'=>$customer->getEmail(),
                    'customer_password'=>'',
                    'customer_phone'=>'',
                    'customer_address'=>'',
                    'customer_vip'=>1,
                ]);
            }
            $customernew->login()->associate($compare);
            $customernew->save();

            $name = Customer::where('customer_id', $customernew->user_id)->first();
            session()->put('customer_name', $name->customer_full_name);
            session()->put('customer_id', $name->customer_id);
            return \redirect('/')->with('message','Đăng nhập tài khoản facebook thành công');
        }
    }

}
