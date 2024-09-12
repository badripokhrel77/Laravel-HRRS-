@extends('layout.admin')
@section('content')
<style>
    .badge {
        font-size: 12px; /* Adjust font size for badges */
        padding: 0.375rem 0.5625rem; /* Adjust padding */
        border-radius: 0; /* Consistent border radius */
        line-height: 1; /* Align text properly */
    }

    .btn-action {
        font-size: 12px; /* Adjust action button size */
        padding: 0.375rem 0.5625rem; /* Adjust padding */
        border-radius: 0; /* Ensure consistent border radius */
        line-height: 1; /* Align text properly */
    }

    .btn-action i {
        margin-right: 0; /* Remove margin for action button icons */
    }
</style>

@if (session()->has('success'))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Users Details</h1>
    {{-- <a href="{{ route('rooms.create') }}" class="btn btn-primary">Add Room</a> --}}
</div>

<!-- Wrap the table inside a responsive container -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr style="background-color: rgb(107, 177, 224); color: rgb(7, 0, 0); font-weight: bold;">
                <th>SN</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($userinfo as $key => $User)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $User->f_name }} {{ $User->l_name }}</td>
                    <td>{{ $User->address }}</td>
                    <td>{{ $User->phone }}</td>
                    <td>{{ $User->email }}</td>
                    <td>
                        <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                            <li style="display: inline-block;">
                                <a href="{{ route('userinfo.edit', $User->id) }}" class="btn btn-primary btn-sm btn-action">
                                    <i class="fa fa-pencil-alt"></i>
                                </a>
                            </li>
                            <li style="display: inline-block;">
                                <form action="{{ route('userinfo.destroy', $User->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-action">
                                        <i class="fa fa-times"></i> 
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center">No Data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $userinfo->links() }}
</div>
@endsection
