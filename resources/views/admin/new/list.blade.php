
@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Tiêu Đề</th>
            <th >description</th>
            <th>Ảnh</th>
            <th>Tác giả</th>
            <th>active</th>
            <th>thời gian tạo</th>
            <th style="width: 100px">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        @foreach($news as $key => $new)
            <tr>
                <td>{{ $new->id }}</td>
                <td>{{ $new->Blog_title }}</td>
                <td >{{ $new->description }}</td>
                <td><a href="{{ $new->thumb }}" target="_blank">
                        <img src="{{ asset($new->thumb) }}" height="40px">
                    </a>
                </td>
                <td>{{ $new->author }}</td>
                <td>{!! \App\Helpers\Helper::active($new->active) !!}</td>
                <td>{{ $new->updated_at }}</td>
                <td>
                    <a class="btn btn-primary btn-sm"
                       href="{{ route('news.edit', ['id' => $new->id]) }}">

                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                        onclick="removeRow({{ $new->id }}, '{{ route('news.destroy', ['id' => $new->id]) }}')">

                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

  <!--   {!! $news->links() !!} -->
@endsection




