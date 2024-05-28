<?php

namespace App\Http\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

//use Symfony\Component\HttpFoundation\Session\Flash;

class UserService
{

    public function create($request)
    {

        try {
            // Check if email already exists
            $existingUser = User::where('email', $request->input('email'))->first();
            if ($existingUser) {
                Session::flash('error', 'Email đã tồn tại');
                return false;
            }

            User::create([
                'name' => (string)$request->input('name'),
                'email' => (string)$request->input('email'),
                'password' => Hash::make($request->input('password')),
//                'level' => (string)$request->input('level'),
                'active' => (string) $request->input('active')
            ]);

            Session::flash('success', 'Tạo người dùng thành công');
            return true;
        } catch (\Exception $err) {
            Session::flash('error', $err->getMessage());
            return false;
        }
    }
    public function getAll()
    {

        return User::orderbyDesc('id')->paginate(20); //sắp xếp theo lơn nhất orderbyDesc

    }
    public function destroy($request)
    {
        $id = (int)$request->input('id');
        $user = User::where('id', $id)->first();
        if ($user) {
            return User::where('id',$id)->delete();
        }
        return false;
    }
    public function update(Request $request, User $user)
    {
//        try {
//            $user->name = $request->input('name');
//            $user->email = $request->input('email');
//            if ($request->has('password')) {
//                $user->password = Hash::make($request->input('password'));
//            }
//            $user->level = (string)$request->input('level');
//            $user->active = (string)$request->input('active');
//
//
//            $user->save();
//            return true;
//        } catch (\Exception $err) {
//            \Log::error($err->getMessage());
//            return false;
//        }
    }
}
