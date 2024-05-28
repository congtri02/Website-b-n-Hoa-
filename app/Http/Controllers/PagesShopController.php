<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Session;
use Redirect;
use Hash;
use Auth;
use App\Http\Services\User\UserShopService;

class PagesShopController extends Controller
{
    protected $usershopService;

    public function __construct(UserShopService $usershopService)
    {
        $this->usershopService = $usershopService;
    }
    function index()
    {

        return view('pages.login',[
            'title' => 'Đăng nhập']);
    }

    public function logout()
    {
        Auth::guard("user")->logout();
        return Redirect::route('home');
    }

    function store(Request $request )
    {
       
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:32',

        ], [
            'email.required' => 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được vượt quá 32 ký tự',
        ]);


         if(Auth::guard('user')->attempt([
            
            'email'=>$request->email,
            'password' => $request->password

            ],$request->remember))
        {
            return redirect()->back();
        }
        
        $user = User::where('email', $request->email)->first();

        
        $remember = (Request()->get('LoginRememberMe') == 'on') ? true : false;

        Auth::guard('user')->login($user, $remember);

        return redirect()->route('home');
        
    }
    public function dangki()
    {
        return view('pages.dangki', ['title' => 'Đăng ký người dùng']);
    }

    public function dangkinguoidung(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:usershop,email',
            'password' => 'required|min:6|max:32',
            'passwordAgain' => 'required|same:password',
        ], [
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu không được vượt quá 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại không khớp',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $result = $this->usershopService->create($request);

        if ($result) {
            Session::flash('success', 'Đăng ký người dùng thành công');
            return redirect()->route('pages.login');
        } else {
            Session::flash('error', 'Đã có lỗi xảy ra');
            return redirect()->back()->withInput();
        }
    }
}
