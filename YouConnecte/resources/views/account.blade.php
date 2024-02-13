
@extends('layout')

@section('content')

<div class="container p-5">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-sm-8 border rounded mb-2 p-3">
            <h1 class="text-center">Create account</h1>
            <form action="{{route('accountCreat')}}" method="POST" onsubmit="return validateForm()">
                @csrf
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" value="register" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <hr>
            <p class="text-center">Already have an account? <a href="{{route('home')}}">Login</a></p>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        var firstName = document.getElementById('firstName').value;
        var lastName = document.getElementById('lastName').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        // Check if any field is empty
        if (firstName == "" || lastName == "" || email == "" || password == "") {
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