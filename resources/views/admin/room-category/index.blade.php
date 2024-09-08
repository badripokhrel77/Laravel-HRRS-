@extends('layout.admin')
@section('content')
    @if (session()->has('success'))
        <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="mb-0">Room List</h1>
        <a href="{{ route('roomcategory.create') }}" class="btn btn-primary">Add Room Category</a>
    </div>

    <table class="table">
        <tr style="background-color: rgb(236, 229, 229); color: rgb(7, 0, 0); font-weight: bold;">

            <th>SN</th>
            <th>Title</th>
            <th>Image</th>
            <Th>Description</Th>
            <th>Action</th>
        </tr>
        @forelse ($categories as $key => $category)
            <tr>
                <td>{{ ++$key }}</td>
                <th>{{ $category->title }}</th>
                <th><a target="_blank" href="{{ asset($category->image) }}"><img src="{{ asset($category->image) }}" alt="Room Image"
                            style="height: 60px; width: auto;">
                    </a></th>
                <th>{{ $category->description }}</th>
                <th>
                    <a href="{{ route('roomcategory.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                   
                    {{-- <a href="{{ route('rooms.index', $room->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                    <form action="{{ route('roomcategory.destroy', $category->id) }}" method="POST" style="display: inline;">
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
        {{ $categories->links() }}
    </div>
@endsection
