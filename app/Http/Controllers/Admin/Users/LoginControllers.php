<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role_Has_Permission;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class LoginControllers extends Controller
{
    public function index(){
        return view('admin.users.login');
    }
    public function login(Request $request){
        $data = Validator::make($request->all(), [
            'admin_email' => ['required', 'email:filter', 'max:100'],
            'admin_password' => ['required', 'max:100', Password::min(8)->letters()->mixedCase()->symbols()->numbers()->uncompromised()],
        ], [
            'admin_email.required' => 'Vui lòng nhập email',
            'admin_email.email' => 'Vui lòng nhập đúng định dạng email',
            'admin_email.max' => 'Email tối đa là 100 kí tự',
            'admin_password.required' => 'Vui lòng nhập mật khẩu',
            'admin_password.max' => 'Mật khẩu tối đa là 100 kí tự',
            'admin_password.min' => 'Mật khẩu tối thiểu là 8 kí tự',
        ])->validate();
        $email = $data['admin_email'];
        $password = md5($data['admin_password']);
        $admin = Admin::where('admin_email',$email)->where('admin_password',$password)->first();
        if($admin){
            $roleadmin = Role_Has_Permission::where('admin_id',$admin->admin_id)->where('permission_id',1)->get();
            if($roleadmin->count()>0){
                session()->put('admin_name',$admin->admin_full_name);
                session()->put('admin_id',$admin->admin_id);

                Toastr::success("Đăng nhập thành công", "Thành công");
                return Redirect::to("/admin/dashboard");
            }
            $rolestaff = Role_Has_Permission::where('admin_id',$admin->admin_id)->where('permission_id',2)->get();
            if($rolestaff->count()>0){
                session()->put('staff_name',$admin->admin_full_name);
                session()->put('staff_id',$admin->admin_id);

                Toastr::success("Đăng nhập thành công", "Thành công");
                return Redirect::to("/staff");
            }
        }else{
            return redirect()->back()->with('login','Bạn đăng nhập không thành công!');
        }

    }
    public function logout(){
        if(session()->get('admin_id')){
            session()->put('admin_name',null);
            session()->put('admin_id',null);
            return \redirect('/admin');
        }elseif(session()->get('staff_id')){
            session()->put('staff_name',null);
            session()->put('staff_id',null);
            return \redirect('/admin');
        }
    }
}
