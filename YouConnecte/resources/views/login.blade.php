@extends('layout')

@section('content')


@if(session('success'))
<div class="alert alert-success" id="alert">
    {{ session('success') }}
</div>
@endif

<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-8 border rounded mb-2 p-3">
            <h1 class="text-center">Login</h1>
            <form action="{{route('login')}}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" value="login" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <hr>
            <p class="text-center">Don't have an account? <a href="{{route('account')}}">Create one</a></p>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Check if any field is empty
        if (email == "" || password == "") {
            alert('Please fill in all fields');
            return false;
        }

        // Validate email format
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert('Please enter a valid email address');
            return false;
        }

        // Validate password length
        if (password.length < 8) {
            alert('Password must be at least 8 characters long');
            return false;
        }

        return true;
    }
</script>
@endsection