@extends('layout')

@section('content')

<div class="container mt-5 mb-5">
    @foreach ($publications as $publication)
    <div class="row d-flex align-items-center justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="d-flex justify-content-between p-2 px-3">
                    @if ( $publication->user->status === 'inactive')
                    <div class="d-flex flex-row align-items-center"> <img src="{{ asset('images/149071.png') }}" width="50" class="rounded-circle">
                        <div class="d-flex flex-column ml-2"> <span class="name">User</span></div>
                    </div>
                    @else
                    <div class="d-flex flex-row align-items-center"> <img src="{{ asset('images/profile_avatar.png') }}" width="50" class="rounded-circle">
                        <div class="d-flex flex-column ml-2"> <span class="name">{{$publication->user->name}}</span></div>
                    </div>
                    @endif
                    <div id="{{ $publication->id }}">
                        @if(session('user_id'))
                        @if ($publication->like->contains('user_id',session('user_id') ))
                        <div class="like-icon" onclick="deletLike('{{ $publication->id }}')" id="{{ $publication->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="red" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                            <i>{{$publication->like->count()}}</i>
                        </div>
                        @else
                        <div onclick="addLike('{{ $publication->id }}')" id="{{ $publication->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                            <i>{{$publication->like->count()}}</i>
                        </div>
                        @endif
                        @else
                        <div class="like-icon">
                            <a href="{{ route('home') }}"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ff0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                </svg></a>

                            <i>{{$publication->like->count()}}</i>
                        </div>
                        @endif
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
                        @if ($publication->comments)
                        @foreach($publication->comments as $comment)
                        @if ( $comment->user->status === 'inactive')
                        <div class="d-flex flex-row mb-2"> <img src="{{ asset('images/149071.png') }}" width="30" class="rounded-image">
                            <div class="d-flex flex-column ml-4"> <span class="name">User</span>
                                @else
                                <div class="d-flex flex-row mb-2"> <img src="{{ asset('images/profile_avatar.png') }}" width="30" class="rounded-image">
                                    <div class="d-flex flex-column ml-4"> <span class="name">{{$comment->user->name}}</span>
                                        @endif
                                        <small class="comment-text">{{$comment->content}}</small>
                                        <!-- <div class="d-flex flex-row align-items-center status"> <small>Like</small> <small>Reply</small> <small>Translate</small> <small>18 mins</small> </div> -->
                                    </div>
                                </div>
                                <!-- <div class="comment-input"> <input type="text" class="form-control">
                            <div class="fonts"> <i class="fa fa-camera"></i> </div>
                        </div> -->
                                @endforeach
                                @endif
                                <a class="d-flex flex-row muted-color" href="{{ route('poste', ['id' => $publication->id]) }}"> >>View More<< </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
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
        <script>
            function addLike(id) {
                let url = `/likes/${id}`;

                let xml = new XMLHttpRequest();
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log("pub" + id);
                        document.getElementById(id).innerHTML = xml.responseText;
                    }
                };
                xml.open("GET", url, true);
                xml.send();
            }

            function deletLike(id) {
                let url = `/likesdelet/${id}`;
                let xml = new XMLHttpRequest();
                xml.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log("pub" + id);
                        document.getElementById(id).innerHTML = xml.responseText;
                        alert("yes delet");
                    }
                };
                xml.open("GET", url, true);
                xml.send();
            }
        </script>

        @endsection