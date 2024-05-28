@extends('admin.main')

@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}?v={{time()}}"></script>

@endsection

@section('content')
    <form action="{{ route('user.edit', $user->id) }}" method="POST">
        <div class="card-body">

            <div class="form-group">
                <label for="menu">Tên người dùng</label>
                <input value="{{ $user->name }}" type="text" name="name" class="form-control"  placeholder="Nhập tên người dùng">
            </div>

            <div class="form-group">
                <label for="menu">Email</label>
                <input  type="email" name="email" class="form-control"  placeholder="Nhập địa chỉ email">
            </div>

            <div class="form-group">
                <label for="menu">Passwork mới</label>
                <input  type="password" name="password" class="form-control"  placeholder="Nhập mật khẩu">
            </div>

            <div class="form-group">
                <label for="menu">nhập lại Passwork mới</label>
                <input type="password" name="passwordAgain" class="form-control"  placeholder="Nhập lại mật khẩu">
            </div>

{{--            <div class="form-group">--}}
{{--                <label>Level</label>--}}
{{--                <div class="custom-control custom-radio">--}}
{{--                    <input class="custom-control-input" value="0" type="radio" name="level" checked id="admin">--}}
{{--                    <label for="admin" class="custom-control-label">Admin</label>--}}
{{--                </div>--}}
{{--                <div class="custom-control custom-radio">--}}
{{--                    <input class="custom-control-input" value="1" type="radio" name="level" id="client">--}}
{{--                    <label for="client" class="custom-control-label">Client</label>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{$user->active == 1 ? 'checked=""' : ''}}>
                    <label for="active" class="custom-control-label" >Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{$user->active == 1 ? 'checked=""' : ''}}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">cập nhật</button>
        </div>
        <input type="hidden" name="id_user" value="{{ $user->id }}">
        @csrf
    </form>
@endsection

@section('footer')

@endsection
