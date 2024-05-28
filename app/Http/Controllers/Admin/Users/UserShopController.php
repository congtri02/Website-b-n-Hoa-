<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\User\UserService;
use App\Models\User;
use Illuminate\Http\Request;

use DB;
use Session;

class UserShopController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function create()
    {
        return view('admin.users.add',[
            'title' => 'Quản lý người dùng',
            ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
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

        $result = $this->userService->create($request);

        if ($result) {
            Session::flash('success', 'Tạo người dùng thành công');
        } else {
            Session::flash('error', 'Đã có lỗi xảy ra');
        }

        return redirect()->back();
    }
    public function index()
    {
        $user = User::paginate(10);;
        return view('admin.users.list',[
            'title' => 'danh sách người dùng',
            'user'=>$user,
            'users' => $this->userService->getAll()
        ]);
    }
    public function show( $id,User $user)
    {
//        dd($id->name);
        $dataUser = $user->where("id",$id)->first();
        return view('admin.users.edit', [
            'title' => 'Chỉnh Sửa user :' . $user->name,
            'user'  => $dataUser
        ]);

    }
     public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:32',
            'passwordAgain' => 'required|same:password',
            'level' => 'required'
        ]);

        $result = $user->where(
            [
                "id" => $request->id_user
            ])->update(
            [
                'name' => $request->name,
                'email'=> $request->email,
                'password'=> $request->password,
                'active'=> $request->active
            ]
        );

        if ($result) {
            Session::flash('success', 'Cập nhật thành công');
            return redirect('/user/list');
        }

        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        $result = $this->userService->destroy($request);
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành Người dùng'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

}
//store
//        dd($request->input());
//        $this->validate($request, [
//            'name' => 'required|min:3',
//            'email' => 'required|email|unique:user,email',
//            'password' => 'required|min:3|max:32',
//            'passwordAgain'=>'required|same:password'
//        ],[
//            'name.required'=>'ban chua nhap ten nguoi dung',
//            'name.min'=>'tên người dùng phải có ít nhất 3ki tự',
//            'email.required'=>'bạn chưa nhập gmail',
//            'email.email'=>'ban chưa nhập đúng inịnh dạng email',
//            'email.unique'=>'email đã tồn tại',
//            'password.required'=>'ban chua nhap mật khẩu',
//            'password.min'=>' mật khẩu phải có ít nhất 3ki tự',
//            'password.max'=>' mật khẩu không quá 32ki tự',
//            'passwordAgain.required'=>'ban chua nhap lại mật khẩu',
//            'passwordAgain.same'=>' mật khẩu không khớp',
//
//        ]);
