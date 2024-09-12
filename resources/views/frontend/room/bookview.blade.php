@extends('layout.main')
@section('title', 'Reservation Details')
@section('content')
<div style=" background-color:rgb(167, 189, 193); display: flex; justify-content: center; align-items: center; height: 100vh;">
    @if (session()->has('success'))
    <div class="alert bg-success">{{ session()->get('success') }}</div>
@endif
    <div class="col-lg-8">
        <div class="card mb-4" style="border: 1px solid rgb(2, 9, 71);">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Full Name :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->name }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Phone Number :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->phone }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Check In Date :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->checkin }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Check Out Date :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->checkout}}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Room Type :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->roomtype }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Room Name :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->roomno }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Number of Guests :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->guestn }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Special Request :</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $book->message }}</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0" style="color: rgb(2, 9, 71);">Payment Status :</p>
                    </div>
                    <div class="col-sm-9">
                        @if($book->status == 'pending')
                            <label class="badge badge-danger">Pending</label>
                        @else
                            <label class="badge badge-success">{{ $book->status }}</label>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
