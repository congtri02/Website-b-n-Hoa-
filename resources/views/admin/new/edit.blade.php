@extends('admin.main')
{{--#5386b9--}}
@section('head')
    <script src="{{ asset('ckeditor/ckeditor.js') }}?v={{time()}}"></script>
@endsection

@section('content')
    <form action="{{route('news.edit', $news->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="menu">Tiêu đề </label>
                        <input type="text" name="Blog_title" value="{{ $news->Blog_title }}" class="form-control"  placeholder="Nhập tiêu đề...">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Mô Tả </label>
                <textarea name="description" class="form-control">{{ $news->description }}</textarea>
            </div>

            <div class="form-group">
                <label>Mô Tả Chi Tiết</label>
                <textarea name="content" id="content" class="form-control">{{ $news->content }}</textarea>
            </div>

            <div class="form-group">
                <label for="menu">Ảnh nền tin tức</label>
                <input type="file"  class="form-control" id="upload">
                <div id="image_show">
                    <a href="{{ $news->thumb }}">
                        <img src="{{ $news->thumb }}" width="100px">
                    </a>
                </div>
                <input type="hidden" name="thumb" value="{{ $news->thumb }}" id="thumb">

            </div>

            <div class="form-group">
                <label for="menu">Tác giả </label>
                <input type="text" name="author" value="{{ $news->author }}" class="form-control"  placeholder="Nhập tên tác giả...">
            </div>

            <div class="form-group">
                <label>Kích Hoạt</label>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="1" type="radio" id="active" name="active"
                        {{ $news->active == 1 ? 'checked' : '' }}>
                    <label for="active" class="custom-control-label">Có</label>
                </div>
                <div class="custom-control custom-radio">
                    <input class="custom-control-input" value="0" type="radio" id="no_active" name="active"
                        {{ $news->active == 0 ? 'checked' : '' }}>
                    <label for="no_active" class="custom-control-label">Không</label>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">cập nhật tin tức</button>
            </div>
        </div>
    </form>
@endsection

@section('footer')
    <script>
        var uploadRoute = '{{ route('upload.services') }}';

        ClassicEditor
            .create( document.querySelector( '#content' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
