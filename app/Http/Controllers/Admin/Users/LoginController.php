<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Hash;
use Auth;
class LoginController extends Controller
{
    //
    public function index(){
    	
    	// echo  Hash::make("admin123");exit;

    	return view('admin.users.login',[
    		'title' => 'Đăng nhập Hệ Thống'
    	]);		
  	}

  	public function store(Request $request){
      // dd($request->input());
  		// $remember = isset($request->input('remember')) ? true : false;
	     $validator = Validator::make($request->all(), [
	        'email' => 'required|email',
	        'password' => 'required|min:6',
	    ]);
 
 
        if ($validator->fails()) {
   
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }


	    if(Auth::guard('admin')->attempt([
	    	'email'=>$request->input('email'),
			 'password' => $request ->input('password')
			],$request->input('remember')))
	    {
	    	return redirect()->back();
	    	
	    }

      $admin = \App\Models\Admin::where('email', $request->email)->first();
      if(empty($admin)){
      
        return redirect()->back();
      }
      
      $remember = (Request()->get('LoginRememberMe') == 'on') ? true : false;
      Auth::guard('admin')->login($admin, $remember);
	    return redirect()->route('admin.main');
	    

  	}
    public function logout()
    {
        Auth::guard("user")->logout();
        return Redirect::route('admin.login');
    }
}