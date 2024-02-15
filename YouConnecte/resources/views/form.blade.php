@extends('layout')

@section('content')

<div class="contanrel p-5 m-5 bg-body-tertiary">




    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" id="id_Pb" onclick="get()" data-bs-toggle="modal" value="1" data-bs-target="#exampleModal">
        Launch demo modal
    </button>


    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publications as $publication)
            <tr>
                <td>
                    <button type="button" class="btn btn-primary" id="id_Pb" onclick="get()" data-bs-toggle="modal" value="{{$publication->id)}}" data-bs-target="#exampleModal">
                        Launch demo modal
                    </button>
                    <form action="{{ route('book.destroy', $publication->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="container" id="publication">

    </div>
</div>

<script>
    function get() {
        let input = document.getElementById("id_Pb").value;
        let url = `/{{ id_Pb }}/edit`;

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