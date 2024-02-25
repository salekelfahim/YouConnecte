@extends('layout')

@section('content')

<div style="width :30%" class="input-group rounded">
    <input type="search" id="search_title" class="form-control rounded" placeholder="Search" name="title_s" aria-label="Search" aria-describedby="search-addon" />
    <span class="input-group-text border-0" id="search-addon">
        <i class="fas fa-search"></i>
    </span>
</div>
<div class="container">
    <div class="main-body">


        <div id="searchResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 gutters-sm">
            @isset($users)
            @foreach($users as $user)
            <div class="col mb-3">
                <div class="card">
                    <img src="{{ asset('images/62.png') }}" alt="Cover" class="card-img-top">
                    <div class="card-body text-center">
                        <img src="{{ asset('images/profile_avatar.png') }}" style="width:100px;margin-top:-65px" alt="User" class="img-fluid img-thumbnail rounded-circle border-0 mb-3">
                        <h5 class="card-title">{{$user->name}}</h5>
                        <p class="text-secondary mb-1">Full Stack Developer</p>
                        <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                    </div>
                    <div class="card-footer">
                        <div id="{{ $user->id }}">
                            <div>
                                @if ($user->abonne->contains('user_id', session('user_id')))
                                <div class="like-icon" onclick="nf('{{ $user->id }}')">
                                    <button class="btn btn-light btn-sm bg-white has-icon btn-block" type="button">
                                        Following</button>
                                </div>

                                @else
                                <div class="like-icon" onclick="f('{{ $user->id }}')">
                                    <button class="btn btn-light btn-sm bg-white has-icon btn-block" type="button">
                                        <i class="material-icons">add</i>Follow</button>
                                </div>

                                @endif
                            </div>
                        </div>

                        <button class="btn btn-light btn-sm bg-white has-icon ml-2" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg></button>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <p>No users found for ''</p>
            @endisset
        </div>
    </div>
</div>


<style>
    body {
        margin-top: 20px;
        color: #1a202c;
        text-align: left;
        background-color: #eee;

    }

    .main-body {
        padding: 15px;
    }

    .card {
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid rgba(0, 0, 0, .125);
        border-radius: .25rem;
    }

    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 1rem;
    }

    .gutters-sm {
        margin-right: -8px;
        margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
        padding-right: 8px;
        padding-left: 8px;
    }

    .mb-3,
    .my-3 {
        margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
        background-color: #e2e8f0;
    }

    .h-100 {
        height: 100% !important;
    }

    .shadow-none {
        box-shadow: none !important;
    }

    .bg-white {
        background-color: #fff !important;
    }

    .btn-light {
        color: #1a202c;
        background-color: #fff;
        border-color: #cbd5e0;
    }

    .ml-2,
    .mx-2 {
        margin-left: .5rem !important;
    }

    .card-footer:last-child {
        border-radius: 0 0 .25rem .25rem;
    }

    .card-footer,
    .card-header {
        display: flex;
        align-items: center;
    }

    .card-footer {
        padding: .5rem 1rem;
        background-color: #fff;
        border-top: 0 solid rgba(0, 0, 0, .125);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var searchTitleInput = document.getElementById("search_title");
        var searchResultContainer = document.getElementById("searchResults");

        searchTitleInput.addEventListener("keyup", function() {
            var title = searchTitleInput.value;

            $.ajax({
                type: 'GET',
                url: '/searchs/',
                data: {
                    title_s: title
                },
                success: function(data) {
                    searchResultContainer.innerHTML = data;
                },
                error: function(error) {
                    console.error("Error during search:", error);
                }
            });
        });
    });

    function f(id) {
        let url = `/abonne/${id}`;

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(id)
                console.log(xml.responseText);
                document.getElementById(id).innerHTML = xml.responseText;
            }
        };
        xml.open("GET", url, true);
        xml.send();
    }

    function nf(id) {
        let url = `/abonneDestroy/${id}`;
        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(id)
                console.log(xml.responseText);
                document.getElementById(id).innerHTML = xml.responseText;
            }
        };
        xml.open("GET", url, true);
        xml.send();
    }
</script>

@endsection