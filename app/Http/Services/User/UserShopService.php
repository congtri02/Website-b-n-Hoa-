<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use DB;
class UserShopService
{
    public function create($request)
    {

        try {
           
            $existingUser = User::where('email', $request->input('email'))->first();
            if ($existingUser) {
                Session::flash('error', 'Email đã tồn tại');
                return false;
            }
            
            $dataUser = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->password), 
                'active' => 1,
            ];

            // dd($request);
            
            DB::table('usershop')->insert($dataUser);

            // User::create($dataUser);

            return true; 
        } catch (\Exception $err) {
            // dd($err->getMessage());
            Session::flash('error', $err->getMessage());
            return false; 
        }
    }

}
