<?php

namespace App\Http\Controllers\Admin\Statistical;

use App\Http\Controllers\Controller;
use App\Models\Statistical;
use App\Models\Blog;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticalController extends Controller
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
    public function getDateFilter(Request $request)
    {
        $this->isLogin();
        $data = $request->all();

        $statistical = Statistical::whereBetween('order_date',[$data['dateFrom'],$data['dateTo']])->orderBy('order_date','ASC')->get();

        foreach($statistical as $value){
            $char[] = array(
                'orderDate'=> $value->order_date,
                'totalOrder'=> $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        echo $data = json_encode($char);
    }
    public function filterStatisticalProfit(Request $request)
    {
        $this->isLogin();
        $data = $request->all();

        $char = array();

        $startOfMonthNow = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $monthPrev = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $monthNext = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sevenDay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $onewYear = Carbon::now('Asia/Ho_Chi_Minh')->subYears(2)->startOfYear()->toDateString();

        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($data['value']=='sevenDay'){
            $result = Statistical::whereBetween('order_date',[$sevenDay,$dateNow])->get();
        }elseif($data['value']=='monthPrev'){
            $result = Statistical::whereBetween('order_date',[$monthPrev,$monthNext])->get();

        }elseif($data['value']=='monthNext'){
            $result = Statistical::whereBetween('order_date',[$startOfMonthNow,$dateNow])->get();
        }elseif($data['value']=='oneYear'){
            $result = Statistical::whereBetween('order_date',[$onewYear,$dateNow])->get();
        }
        foreach($result as $value){
            $char[] = array(
                'orderDate'=> $value->order_date,
                'totalOrder'=> $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        echo $data = json_encode($char);
    }
    public function showStatisticalOnewYear(Request $request)
    {
        $this->isLogin();
        $char = array();

        $oneYear = Carbon::now('Asia/Ho_Chi_Minh')->subYears(2)->startOfYear()->toDateString();
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $result = Statistical::whereBetween('order_date',[$oneYear,$dateNow])->get();

        foreach($result as $value){
            $char[] = array(
                'orderDate'=> $value->order_date,
                'totalOrder'=> $value->total_order,
                'sales' => $value->sales,
                'profit' => $value->profit,
                'quantity' => $value->quantity,
            );
        }
        echo $data = json_encode($char);
    }
    public function showStatistical(Request $request)
    {
        $this->isLogin();
        $ip_address = $request->ip();
        // $ip_address = '156.145.221.45';

        $startOfMonthNow = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $monthPrev = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $monthNext = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $onewYear = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $visitorLastMonth = Visitor::whereBetween('visitor_date',[$monthPrev,$monthNext])->get();
        $countVisitorLastMonth = $visitorLastMonth->count();

        $visitorThisMonth = Visitor::whereBetween('visitor_date',[$monthPrev,$dateNow])->get();
        $countVisitorThisMonth = $visitorThisMonth->count();

        $visitorThisYear = Visitor::whereBetween('visitor_date',[$onewYear,$dateNow])->get();
        $countVisitorThisYear = $visitorThisYear->count();

        $visitorOnline =  Visitor::where('visitor_ip_address',$ip_address)->get();
        $count = $visitorOnline->count();

        $visitorAll = Visitor::all()->count();

        if($count<1){
            $visitor = new Visitor();
            $visitor->visitor_ip_address = $ip_address;
            $visitor->visitor_date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        $customerAll = Customer::all()->count();
        $orderAll = Order::all()->count();
        $productAll = Product::all()->count();
        $blogAll = Blog::all()->count();

        $product_customer_view = Product::orderBy('product_customer_views','DESC')->get();
        return view('admin.statistical.show_statistical')->with(compact('count','visitorAll','countVisitorLastMonth','countVisitorThisMonth',
        'countVisitorThisYear','customerAll','orderAll',
        'productAll','blogAll','product_customer_view'));
    }
}
