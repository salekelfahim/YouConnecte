@extends('layout')

@section('content')


<div class="container mt-5 mb-5">
<div class="container" id="publication">

</div> 
    <div class="container p-5 m-5 bg-body-tertiary">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            what in your mind ?
        </button>
       

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h1>Create Book</h1>
                        <form action="{{ route('publication.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="content" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($publications as $publication)
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
                    <button type="button" class="btn btn-primary" onclick="get('{{ $publication->id }}')">
                        Update
                    </button>
                    <form action="{{ route('publication.destroy', $publication->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                    </form>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-row icons d-flex align-items-center"> <i class="fa fa-heart"></i> <i class="fa fa-smile-o ml-2"></i> </div>
                        <!-- <div class="d-flex flex-row muted-color"> <span>2 comments</span> </div> -->
                    </div>
                    <hr>
                    <div class="comments">
                        <div class="d-flex flex-row mb-2"> <img src="{{ asset('images/profile_avatar.png') }}" width="30" class="rounded-image">
                            <div class="d-flex flex-column ml-4"> <span class="name">Daniel Frozer</span> <small class="comment-text">I like this alot! thanks alot</small>
                                <!-- <div class="d-flex flex-row align-items-center status"> <small>Like</small> <small>Reply</small> <small>Translate</small> <small>18 mins</small> </div> -->
                            </div>
                        </div>
                        <!-- <div class="comment-input"> <input type="text" class="form-control">
                            <div class="fonts"> <i class="fa fa-camera"></i> </div>
                        </div> -->
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




</div>
<script>
    function get(id) {
        let url = `/${id}/edit`;

        let xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("publication").innerHTML = xml.responseText;
            }
        };
        xml.open("GET", url, true);
        xml.send();
    }
</script>

@endsection