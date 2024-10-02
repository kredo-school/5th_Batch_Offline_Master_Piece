@extends('layouts.app')

@section('title','Inquiry')

@section('content')
    <div class="container-body w-50">
        <form action="#" method="post">
            @csrf
            <div class="w-75 justify-content-center mx-auto">
                <h2 class="main-text fw-bold">Inquiry</h2>
                <label for="email" class="form-label mt-2">Please fill in your email</label>
                <input type="email" name="email" id="email" class="form-control">

                <label for="firstname" class="form-label mt-2">First Name</label>
                <input type="text" name="firstname" id="firstname" class="form-control">

                <label for="lastname" class="form-label mt-2">Last Name</label>
                <input type="text" name="lastname" id="lastname" class="form-control">

                <label for="phone" class="form-label mt-2">Phone Number</label>
                <input type="number" name="phone" id="phone" class="form-control">

                <label class="form-label mt-2">Role</label><br>
                <input type="radio" name="role" id="store" value="store">
                <label for="store" class="form-label">Store</label>
                <input type="radio" name="role" id="guest" value="guest">
                <label for="guest" class="form-label">Guest</label><br>

                <label for="contact" class="form-label mt-2">Inquiry</label>
                <select name="contact" id="contact" class="form-control">
                    <option value="" hidden>Select the inquiry</option>
                    <option value="store">About store</option>
                    <option value="reserve">Book Reserve</option>
                    <option value="application">Application</option>

                </select>
                <textarea name="details" id="details" cols="30" rows="5" class="form-control mt-2" placeholder="Please fill in the details"></textarea>

                <div class="d-flex justify-content-end mt-2">
                    <input type="submit" value="Send" class="btn btn-select-store px-4">
                </div>
            </div>
        </form>
    </div>

@endsection
