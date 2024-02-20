@extends('layout')

@section('content')

<div class="container mt-5 mb-5">
    <div class="row d-flex align-items-center justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="d-flex justify-content-between p-2 px-3">
                    <div class="d-flex flex-row align-items-center"> <img src="{{ asset('images/profile_avatar.png') }}" width="50" class="rounded-circle">
                        <div class="d-flex flex-column ml-2"> <span class="name">{{$publication->user->name}}</span> <small class="text-primary">Collegues</small> </div>
                    </div>
                    <div class="d-flex flex-row mt-1 ellipsis"> <small class="mr-2">{{$publication->created_at->diffForHumans()}}</small> <i class="fa fa-ellipsis-h"></i> </div>
                </div> <img src="{{ asset('images/Réseau_Social_YouConnecte.png') }}" class="img-fluid">
                <div class="p-2">
                    <p class="text-justify">{{$publication->content}}</p>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-row icons d-flex align-items-center"> <i class="fa fa-heart"></i> <i class="fa fa-smile-o ml-2"></i> </div>
                        <div class="d-flex flex-row muted-color"> <span>{{$publication->comments->count()}} comments</span> </div>
                    </div>
                    <hr>
                    <div class="comments">
                       
                        <form action="{{route('commenter',$publication->id)}}" method="POST">
                            @csrf
                            <div class="comment-input"> <input type="text" class="form-control" name="content">
                                <div class="fonts">
                                    <button name="submit" type="submit" class="btn btn-sm btn-dark float-end">Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap");

    body {
        background-color: #eee;
        font-family: "Poppins", sans-serif;
        font-weight: 300
    }

    .card {
        border: none
    }

    .ellipsis {
        color: #a09c9c
    }

    hr {
        color: #a09c9c;
        margin-top: 4px;
        margin-bottom: 8px
    }

    .muted-color {
        color: #a09c9c;
        font-size: 13px
    }

    .ellipsis i {
        margin-top: 3px;
        cursor: pointer
    }

    .icons i {
        font-size: 25px
    }

    .icons .fa-heart {
        color: red
    }

    .icons .fa-smile-o {
        color: yellow;
        font-size: 29px
    }

    .rounded-image {
        border-radius: 50% !important;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 50px;
        width: 50px
    }

    .name {
        font-weight: 600
    }

    .comment-text {
        font-size: 12px
    }

    .status small {
        margin-right: 10px;
        color: blue
    }

    .form-control {
        border-radius: 26px
    }

    .comment-input {
        position: relative
    }

    .fonts {
        position: absolute;
        right: 13px;
        top: 8px;
        color: #a09c9c
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #8bbafe;
        outline: 0;
        box-shadow: none
    }
</style>

@endsection