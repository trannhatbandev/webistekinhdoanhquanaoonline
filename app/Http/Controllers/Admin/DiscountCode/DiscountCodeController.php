<?php

namespace App\Http\Controllers\Admin\DiscountCode;

use App\Exports\DiscountCodeExport;
use App\Http\Controllers\Controller;
use App\Imports\DiscountCodeImport;
use App\Models\Customer;
use App\Models\CustomerDiscountCode;
use App\Models\Discount_Code;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class DiscountCodeController extends Controller
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
    public function showCreateDiscountCode(){
        $this->isLogin();
        return view('admin.discountcode.create_discount_code');
    }
    public function createDiscountCode(Request $request){
        $this->isLogin();
        $data = $request->validate(
            [
                'discount_code_name' => 'required|unique:discount_code|max:255',
                'discount_code_code' => 'required|unique:discount_code|max:255',
                'discount_code_quantity' => 'required|numeric',
                'discount_code_condition' => 'required',
                'discount_code_price' => 'required|numeric',
                'discount_code_date_start' => 'required',
                'discount_code_date_end' => 'required',

            ],
            [
                'discount_code_name.unique' => 'Tên khuyến mãi đã có xin điền tên khác',
                'discount_code_name.required' => 'Tên khuyến mãi chưa nhập',
                'discount_code_name.max' => 'Tên khuyến mãi tối đa 255 kí tự',
                'discount_code_code.unique' => 'Mã khuyến mãi đã có xin điền mã khác',
                'discount_code_code.required' => 'Mã khuyến mãi chưa nhập',
                'discount_code_code.max' => 'Mã khuyến mãi tối đa 255 kí tự',
                'discount_code_quantity.required' => 'Số lượng mã khuyến mãi phải có',
                'discount_code_quantity.numeric' => 'Số lượng phải là số',
                'discount_code_condition.required' => 'Điều kiện giảm giá phải có',
                'discount_code_price.required' => 'Giá giảm phải có',
                'discount_code_price.numeric' => 'Giá giảm phải là số',
                'discount_code_date_start.required' => 'Ngày bắt đầu mã giảm giá phải có',
                'discount_code_date_end.required' => 'Ngày kết thúc mã giảm giá phải có',

            ]
        );
        $discountCode = new Discount_Code();
        $discountCode->discount_code_name = $data['discount_code_name'];
        $discountCode->discount_code_code = $data['discount_code_code'];
        $discountCode->discount_code_quantity = $data['discount_code_quantity'];
        $discountCode->discount_code_condition = $data['discount_code_condition'];
        $discountCode->discount_code_price = $data['discount_code_price'];
        $discountCode->discount_code_date_start = $data['discount_code_date_start'];
        $discountCode->discount_code_date_end = $data['discount_code_date_end'];

        $discountCode->save();

        Toastr::success("Thêm mã khuyến mãi thành công","Thành công");
        return  Redirect::to("/admin/discount-code/show-discount-code");
    }
    public function showListDiscountCode(){
        $this->isLogin();
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $dicountCodeAll = Discount_Code::all();
        return view('admin.discountcode.show_list_discount_code')->with(compact('dicountCodeAll','date'));
    }
    public function showUpdateDiscountCode($id){
        $this->isLogin();
        $discountCodeUpdate = Discount_Code::find($id);
        return view('admin.discountcode.edit_discount_code')->with(compact('discountCodeUpdate'));
    }
    public function updateDiscountCode(Request $request, $id){
        $this->isLogin();
        $data = $request->validate(
            [
                'discount_code_name' => 'required|max:255',
                'discount_code_code' => 'required|max:255',
                'discount_code_quantity' => 'required|numeric',
                'discount_code_condition' => 'required',
                'discount_code_price' => 'required|numeric',
                'discount_code_date_start' => 'required',
                'discount_code_date_end' => 'required',

            ],
            [
                'discount_code_name.required' => 'Tên khuyến mãi chưa nhập',
                'discount_code_name.max' => 'Tên khuyến mãi tối đa 255 kí tự',
                'discount_code_code.required' => 'Mã khuyến mãi chưa nhập',
                'discount_code_code.max' => 'Mã khuyến mãi tối đa 255 kí tự',
                'discount_code_quantity.required' => 'Số lượng mã khuyến mãi phải có',
                'discount_code_quantity.numeric' => 'Số lượng phải là số',
                'discount_code_condition.required' => 'Điều kiện giảm giá phải có',
                'discount_code_price.required' => 'Giá giảm phải có',
                'discount_code_price.numeric' => 'Giá giảm phải là số',
                'discount_code_date_start.required' => 'Ngày bắt đầu mã giảm giá phải có',
                'discount_code_date_end.required' => 'Ngày kết thúc mã giảm giá phải có',


            ]
        );
        $discountCode = Discount_Code::find($id);
        $discountCode->discount_code_name = $data['discount_code_name'];
        $discountCode->discount_code_code = $data['discount_code_code'];
        $discountCode->discount_code_quantity = $data['discount_code_quantity'];
        $discountCode->discount_code_condition = $data['discount_code_condition'];
        $discountCode->discount_code_price = $data['discount_code_price'];
        $discountCode->discount_code_date_start = $data['discount_code_date_start'];
        $discountCode->discount_code_date_end = $data['discount_code_date_end'];

        $discountCode->save();

        Toastr::success("Cập nhật mã khuyến mãi thành công","Thành công");
        return  Redirect::to("/admin/discount-code/show-discount-code");
    }
    public function deleteDiscountCode($id){
        $this->isLogin();
        Discount_Code::find($id)->delete();
        Toastr::success("Xóa mã khuyến mãi thành công","Thành công");
        return  Redirect::to("/admin/discount-code/show-discount-code");
    }
    //discount code customer
    public function addDiscountCodeCustomer(Request $request){
        $data =$request->all();
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
        $discountCode = Discount_Code::where('discount_code_code',$data['discount_code'])->first();
        $cusdiscountCode='';
        if(session()->get('customer_id')){

                $cusDiscountCode = CustomerDiscountCode::where('discount_code_id',$discountCode->discount_code_id)
                ->where('customer_id',session()->get('customer_id'))->first();
                if($cusDiscountCode==true){
                    return \redirect()->back()->with('message','Mã giảm giá này bạn đã nhập, bạn không thể nhập nữa');
                }else{
                    if($discountCode && strtotime($discountCode->discount_code_date_end)>strtotime($date) &&$discountCode->discount_code_quantity>0){
                        $count = $discountCode->count();
                        if($count>0){
                            $sessionDiscountCode = session()->get('discount_code');
                            if($sessionDiscountCode == true){
                                $is_exist = 1;
                                if($is_exist == 1){
                                    $arrayDiscountCode[]= array(
                                        'discount_code_code' => $discountCode->discount_code_code,
                                        'discount_code_condition' => $discountCode->discount_code_condition,
                                        'discount_code_price' => $discountCode->discount_code_price,
                                        'discount_code_quantity' => $discountCode->discount_code_quantity,
                                    );
                                    session()->put('discount_code',$arrayDiscountCode);
                                }
                            }else{
                                $arrayDiscountCode[]= array(
                                    'discount_code_code' => $discountCode->discount_code_code,
                                    'discount_code_condition' => $discountCode->discount_code_condition,
                                    'discount_code_price' => $discountCode->discount_code_price,
                                    'discount_code_quantity' => $discountCode->discount_code_quantity,
                                );
                                session()->put('discount_code',$arrayDiscountCode);
                            }
                            session()->save();
                            return \redirect()->back()->with('message','Áp dụng mã giảm giá thành công');
                        }
                    }else{
                        return \redirect()->back()->with('message','Mã giảm giá đã hết hạn hoặc không có');
                    }

            }
        }


    }
    public function deleteDiscountCodeCustomer(){
        $sessionDiscountCode = session()->get('discount_code');
        if($sessionDiscountCode){
            session()->forget('discount_code');
            return \redirect()->back()->with('message','Xóa mã khuyến mãi thành công');
        }
    }
    public function importExcelDiscountCode(Request $request){
        $this->isLogin();
        $path = $request->file('discount_code_file_import')->getRealPath();
        Excel::import(new DiscountCodeImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelDiscountCode(){
        $this->isLogin();
        return Excel::download(new DiscountCodeExport(), 'discountcode.xlsx');
    }
    public function sendDiscountCode($discountCodeID)
    {
        $discountCode = Discount_Code::find($discountCodeID);

        $dicountCodeArray = array(
            'discount_code_name'=> $discountCode->discount_code_name,
            'discount_code_code' => $discountCode->discount_code_code,
            'discount_code_price' => $discountCode->discount_code_price,
            'discount_code_condition' => $discountCode->discount_code_condition,
            'discount_code_quantity' => $discountCode->discount_code_quantity,
            'discount_code_date_start' => $discountCode->discount_code_date_start,
            'discount_code_date_end' => $discountCode->discount_code_date_end,
        );
        $customerVip = Customer::where('customer_vip',1)->get();
        $date = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');

        $title = 'Gửi mã khuyến mãi ngày'.' '.$date;

        $data=[];
        foreach($customerVip as $value){
            $data['emailVip'][] = $value->customer_email;
        }

        Mail::send('admin.discountcode.mail_discount_code',['dicountCodeArray'=>$dicountCodeArray],
        function($message) use ($title,$data){
            $message->to($data['emailVip'])->subject($title);
            $message->from($data['emailVip'],$title);
        });

        Toastr::success('Gửi mã khuyến mãi cho khách hàng vip thành công','Thành công');

        return redirect()->back();
    }
}
