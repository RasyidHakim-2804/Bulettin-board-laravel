<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('bootstrap.link')
    <title>Edit</title>
</head>

<body>
    {{-- error jika ada vlidate yang gagagl --}}
    @include('bootstrap.error')

    {{-- form --}}
    <div class="container text-left border-primary p-3 mt-5 w-75">
        <form action="/posts/{{ $id }}" method="POST" enctype="multipart/form-data"
            class="shadow p-4 mb-3 bg-body-tertiary rounded">
            @method('PUT')
            @csrf
            <div class="mb-5">
                <h3>Edit</h3>
            </div>
            <div class="mb-3">
                <label for="title" class="from-label">Title:</label>
                <input type="text" name="title" class="form-control" value="{{ $title }}">
            </div>
            <div class="mb-3">
                <label for="post_contents" class="from-label">Content:</label>
                <textarea name="body" rows="5" style="resize:none" class="form-control">{{ $body }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image: </label>
                <input class="form-control" type="file" id="input-image" name="image">
                @if ($photo)
                    <p>Your image:</p>
                    <img src="/storage/user/post/{{ $photo }}" alt="" class="img-fluid" id="myImage">
                @endif
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-success" name="submit" value="Submit">
                <input type="reset"  class="btn btn-warning"  value="Reset">
                <input type="button" class="btn btn-warning" onclick="deleteImage()" value="Delete Image">
                <a href="/posts" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        function deleteImage() {
            document.getElementById("myImage").src = '';
        }
        
    </script>
    @include('bootstrap.script')
</body>

</html>
