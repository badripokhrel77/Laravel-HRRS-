
@extends('layout.admin')
@section('content')<style>
    .room-form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .room-form .form-group {
        margin-bottom: 15px;
    }

    .room-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .room-form .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .room-form .form-control[type="file"] {
        padding: 5px;
    }

    .room-form .btn-submit {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .room-form .btn-submit:hover {
        background-color: #0056b3;
    }
</style>
<div style="text-align: center; margin-bottom: 20px;">
    <h1 style="color: darkblue;">Room Category Update Section</h1>
</div>


<div class="room-form-container">
    <h1>Edit Room Category</h1>
    @if(session()->has("success"))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif
<form action="{{ route('roomcategory.update', $category->id) }}" method="POST" class="room-form"
    enctype="multipart/form-data">
    @csrf {{  method_field("put") }}
    <div class="form-group">
        <label for="name">Title</label>
        <input type="text" id="name" name="title" value="{{ $category->title }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="image">Room Image</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*" >
        <img src="{{  asset($category->image)  }}" style="height: 50px" alt="">
    </div>
    <div class="form-group">
        <label for="description">Room Description</label>
        <textarea id="description" name="description" class="form-control" rows="4">{{ $category->description  }}</textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn-submit">Update Room Category</button>
    </div>
</form>
</div>

@endsection