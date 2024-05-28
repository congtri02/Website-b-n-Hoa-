@extends('admin.main')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th style="width: 50px">ID</th>
            <th>Name</th>
            <th>Email</th>
{{--            <th>Level</th>--}}
{{--            <th>Delete</th>--}}
            <th>Active</th>
            <th>Update</th>
            <th style="width: 100px">&nbsp;</th>

        </tr>

        </thead>
        <tbody>
        @foreach($user as  $u)

            <tr>
                <td>{{ $u->id }}</td>
                <td>{{ $u->name }}</td>
                <td>{{ $u->email }}</td>
{{--                <td>{!! \App\Helpers\Helper::level($u->level) !!}</td>--}}
                <td>{!! \App\Helpers\Helper::active($u->active) !!}</td>
                <td>{{ $u->updated_at }}</td>
{{--                        @if($u->level == 0)--}}
{{--                            {{"admin"}}--}}
{{--                        @else--}}
{{--                            {{"client"}}--}}
{{--                         @endif--}}
                <td>
                    <a class="btn btn-primary btn-sm"
                       href="{{ route('user.edit', [$u->id]) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm"
                       onclick="removeRow({{ $u->id }}, '{{ route('user.destroy', ['user' => $u->id]) }}')">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    <div class="card-footer clearfix" style="float: right; text-align: right">
        {!! $user->links() !!}
    </div>

@endsection
