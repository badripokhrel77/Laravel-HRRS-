@extends('layout.admin')
@section('content')
    @if (session()->has('success'))
        <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Users Details</h1>
        {{-- <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a> --}}
    </div>

    <table class="table">
        <tr style="background-color: rgb(236, 229, 229); color: rgb(7, 0, 0); font-weight: bold;">

            <th>SN</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Phone</th>
            <Th>Email</Th>
            <th>Action</th>
        </tr>
        @forelse ($userinfo as $key => $User)
            <tr>
                <td>{{ ++$key }}</td>
                <th>{{ $User->f_name }} {{ $User->l_name }}</th>
                <th>{{ $User->address }}</th>
                <th>{{ $User->phone }}</th>
                <th>{{ $User->email }}</th>
                <th>
                    <a href="{{ route('userinfo.edit', $User->id) }}" class="btn btn-warning btn-sm">Edit</a>
                   
                    {{-- <a href="{{ route('rooms.index', $room->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                    <form action="{{ route('userinfo.destroy', $User->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" > Delete</button>
                    </form>

                </th>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center">No Data Found</td>
            </tr>
        @endforelse
    </table>

    <div class="mt-3">
        {{ $userinfo->links() }}
    </div>
@endsection
