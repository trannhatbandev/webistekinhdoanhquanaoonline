<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminControllers extends Controller
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
    public function showDashboard(Request $request){
        $this->isLogin();

        return view('admin.admin_layout');
    }
}
