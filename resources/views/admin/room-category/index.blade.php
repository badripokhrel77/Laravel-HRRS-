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

    .pagination .page-item.disabled .page-link {
        pointer-events: none;
    }

    .pagination .page-item.active .page-link {
        background-color: rgb(107, 177, 224);
        border-color: rgb(107, 177, 224);
        color: rgb(7, 0, 0);
    }
</style>

@if (session()->has('success'))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Room Categories</h1>
    <a href="{{ route('roomcategory.create') }}" class="btn btn-primary">Add Room Category</a>
</div>

<!-- Add search form -->
<div class="mb-3 d-flex justify-content-end">
    <form action="{{ route('roomcategory.index') }}" method="GET" class="d-flex">
        <!-- Smaller search input box -->
        <input type="text" name="search" class="form-control me-2" style="width: 200px;" placeholder="Search by title" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<!-- Wrap the table inside a responsive container -->
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr style="background-color: rgb(107, 177, 224); color: rgb(7, 0, 0); font-weight: bold;">
                <th>SN</th>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $key => $category)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $category->title }}</td>
                    <td>
                        <a target="_blank" href="{{ asset($category->image) }}">
                            <img src="{{ asset($category->image) }}" alt="Category Image" style="height: 60px; width: auto;">
                        </a>
                    </td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <ul style="list-style: none; padding-left: 0; margin-bottom: 0;">
                            <li style="display: inline-block;">
                                <a href="{{ route('roomcategory.edit', $category->id) }}" class="btn btn-primary btn-sm btn-action">
                                    <i class="fa fa-pencil-alt"></i> 
                                </a>
                            </li>
                            <li style="display: inline-block;">
                                <button type="button" class="btn btn-danger btn-sm btn-action" data-bs-toggle="modal" data-bs-target="#deleteModal" data-form-action="{{ route('roomcategory.destroy', $category->id) }}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </li>
                        </ul>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center">No Data Found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination">
            @if ($categories->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Previous</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">Previous</a>
                </li>
            @endif

            @for ($i = 1; $i <= $categories->lastPage(); $i++)
                <li class="page-item {{ $i == $categories->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            @if ($categories->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">Next</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Next</span>
                </li>
            @endif
        </ul>
    </nav>
</div>

<!-- Bootstrap Modal for Deletion Confirmation -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this category?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" action="#" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            var formAction = button.getAttribute('data-form-action'); // Extract info from data-* attributes
            
            var form = deleteModal.querySelector('#deleteForm');
            form.action = formAction; // Update form action
        });
    });
</script>

@endsection
