@include('admin.head')
<div class="login-logo">
    <a href="#"><b>{{$title}}</b></a>
</div>
<form action="{{route('shop.dangki')}}" method="POST">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="menu">Tên người dùng</label>
            <input type="text" name="name" class="form-control"  placeholder="Nhập tên người dùng" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="menu">Email</label>
            <input type="email" name="email" class="form-control"  placeholder="Nhập địa chỉ email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="menu">Passwork</label>
            <input type="password" name="password" class="form-control"  placeholder="Nhập mật khẩu">
        </div>

        <div class="form-group">
            <label for="menu">Nhập lại Passwork</label>
            <input type="password" name="passwordAgain" class="form-control"  placeholder="Nhập lại mật khẩu">
        </div>

    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Đăng ký</button>
    </div>
    @csrf
</form>
