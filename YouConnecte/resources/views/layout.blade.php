<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YouConnecte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg  navbar-light bg-light ">
        <div class="container">
            <a class="navbar-brand" href="{{ route('accueil') }}">YouConnecte</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                 
                        <a class="nav-link" href="{{ route('publication.create') }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('search') }}">Search</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('chatify') }}">Messages</a>
                    </li>
                </ul>
                <div class="dropdown">
                    <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">

                    @if(session('user_name'))
                        {{ session('user_name') }}
                        @else
                        Login
                        @endif

                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">


                        @if(session('user_name'))
                        <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                       @else
                        <li><a class="dropdown-item" href="{{route('account') }}">Sign in</a></li>
                        <li><a class="dropdown-item" href="{{route('home')}}">Login</a></li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>

    </nav>


    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</body>

</html>