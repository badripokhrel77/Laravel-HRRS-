
@extends('layout.admin')
@section('content')
<style>
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

    .room-form input.form-control {
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
    <h1 style="color: darkblue;">Room Add Section</h1>
</div>

<div class="room-form-container">
    @if(session()->has("success"))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif
<form action="{{ route('rooms.store') }}" method="POST" class="room-form"
    enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">Room Image</label>
        <input type="file" id="image" name="image" class="form-control" accept="image/*" required>
    </div>
    <div class="form-group">
        <label for="name">Room Category</label>
        <select id="roomType" name="category_id" class="form-control ">
            <option selected>Choose...</option>
            @foreach ($categories as $category )
                
            <option value="{{ $category->id }}">{{ $category->title}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name">Room Name</label>
        <input type="text" id="name" name="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="description">Room Description</label>
        <textarea id="description" name="description" class="form-control" rows="4"></textarea>
    </div>
    <div class="form-group">
        <label for="price">Room Price</label>
        <input type="text" id="price" name="price" class="form-control" required>
    </div>
    <div class="form-group">
        <button type="submit" class="btn-submit">Add Room</button>
    </div>
</form>
</div>

@endsection