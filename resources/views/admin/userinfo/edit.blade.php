@extends('layout.admin')
@section('content')
<style>
    .userinfo-form-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .userinfo-form .form-group {
        margin-bottom: 15px;
    }

    .userinfo-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .userinfo-form .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .userinfo-form .btn-submit {
        display: inline-block;
        padding: 10px 15px;
        background-color: #007bff;
        color: #fff;
        text-align: center;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .userinfo-form .btn-submit:hover {
        background-color: #0056b3;
    }
</style>

<div style="text-align: center; margin-bottom: 20px;">
    <h1 style="color: darkblue;">User Information Update Section</h1>
</div>

<div class="userinfo-form-container">
    <h1>Edit User Information</h1>
    @if(session()->has("success"))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
    @endif
    <form action="{{ route('userinfo.update', $userinfo->id) }}" method="POST" class="userinfo-form">
        @csrf
        {{ method_field('put') }}
        <div class="form-group">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="f_name" value="{{ $userinfo->f_name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="l_name" value="{{ $userinfo->l_name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="{{ $userinfo->address }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" value="{{ $userinfo->phone }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $userinfo->email }}" class="form-control" required>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-submit">Update User Information</button>
        </div>
    </form>
</div>

@endsection
