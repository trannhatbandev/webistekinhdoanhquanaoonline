<?php

namespace App\Http\Controllers\Admin\TransportFee;

use App\Exports\TransportFeeExport;
use App\Http\Controllers\Controller;
use App\Imports\TransportFeeImport;
use App\Models\City;
use App\Models\District;
use App\Models\Ward;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\TransportFee;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class TransportFeeController extends Controller
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
    public function showListTransportFee(){
        $this->isLogin();
        $city = City::orderBy('matp','ASC')->get();
        $district = District::orderBy('maqh','ASC')->get();
        $ward = Ward::orderBy('maxptt','ASC')->get();
        $transportFee = TransportFee::orderBy('transport_fee_id','DESC')->get();
        return view('admin.transportfee.show_list_transport_fee')->with(compact('city','district','ward','transportFee'));
    }
    public function selectTransportFee(Request $request){
        $this->isLogin();
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
    public function addTransportFee(Request $request){
        $this->isLogin();
        $data = $request->all();

        $transport_fee = new TransportFee();
        $transport_fee->matp = $data['city'];
        $transport_fee->maqh = $data['district'];
        $transport_fee->maxptt = $data['ward'];
        $transport_fee->transport_fee_freeship = $data['transport_fee_freeship'];

        $transport_fee->save();
        Toastr::success("Thêm phí vận chuyển thành công","Thành công");
        return  Redirect::back();
    }
    public function updateTransportFeeFreeship(Request $request){
        $this->isLogin();
        $data = $request->all();
        $transport_fee = TransportFee::find($data['transport_fee_id']);
        $transport_fee_freeship = $data['transport_fee_freeship'];
        $transport_fee->transport_fee_freeship = $transport_fee_freeship;
        $transport_fee->save();
    }
    public function deleteTransportFee($id){
        $this->isLogin();
        TransportFee::find($id)->delete();
        Toastr::success("Xóa vận chuyển thành công","Thành công");
        return  Redirect::back();
    }
    public function importExcelTransportFee(Request $request){
        $this->isLogin();
        $path = $request->file('transport_fee_file_import')->getRealPath();
        Excel::import(new TransportFeeImport(), $path);
        Toastr::success('Import dữ liệu thành công', 'Thành công');
        return back();
    }
    public function exportExcelTransportFee(){
        $this->isLogin();
        return Excel::download(new TransportFeeExport(), 'transportfee.xlsx');
    }
}




