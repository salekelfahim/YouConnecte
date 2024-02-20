<div class="z-1 position-absolute rounded-3 text-bg-primary  p-5 ">
    <form action="{{ route('publication.update', $publication->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="content" id="title" class="form-control" value="{{  $publication->content }}" required>
        </div>
        <button type="submit" class="btn btn-dark mt-4">submit</button>
    </form>
</div>