@extends('layout')

@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="contanrel p-5 m-5 bg-body-tertiary">
        


        <h1>Create Book</h1>
        <form action="{{ route('book.update',$book->id ) }}" method="POST">
            @csrf
            @method('Put') 
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $book->title }}" required>
            </div>
            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" name="author" id="author" class="form-control" value="{{ $book->author }}" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input name="description" id="description" class="form-control" value="{{ $book->description }}"required>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Update</button>
        </form>



    </div>




    @endsection