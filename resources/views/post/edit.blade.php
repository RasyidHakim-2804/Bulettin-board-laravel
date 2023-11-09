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
                <input type="text" name="title" id="title" class="form-control" value="{{ $title }}">
            </div>
            <div class="mb-3">
                <label for="post_contents" class="from-label">Content:</label>
                <textarea name="body" id="body" rows="5" style="resize:none" class="form-control">{{ $body }}</textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image: </label>
                <input class="form-control" type="file" id="inputImage" name="image"
                    accept="image/png, image/gif, image/jpeg">
                <p>Your image:</p>
                @if ($photo)
                    <img src="/storage/user/post/{{ $photo }}" alt="oldImage" class="img-fluid" id="oldImage">
                    <input type="hidden" name="deleteOldImage" id="deleteOldImage" value="false">
                @endif
                <img src="" alt="preview" class="img-fluid" id="previewImage" style="visibility: hidden;">
            </div>
            <div class="mb-3">
                <input type="submit" class="btn btn-primary" name="submit" value="Simpan">
                <input type="button" class="btn btn-warning" value="Reset" onclick="balik()">
                <input type="button" class="btn btn-warning" onclick="funcDeleteImage()" value="Delete Image">
                <a href="/posts" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>

    {{-- script --}}
    @if ($photo)
        <script>
            document.getElementById('inputImage').onchange = evt => {
                const [file] = document.getElementById('inputImage').files;
                if (file) {
                    document.getElementById("oldImage").style.visibility = "hidden";
                    document.getElementById("oldImage").src = '';

                    document.getElementById("previewImage").style.visibility = "visible";
                    document.getElementById('previewImage').src = URL.createObjectURL(file);

                    document.getElementById("deleteOldImage").value = "false";
                }
            }

            function balik() {
                document.getElementById("oldImage").style.visibility = "visible";
                document.getElementById("oldImage").src = "/storage/user/post/{{ $photo }}";

                document.getElementById("previewImage").style.visibility = "hidden";
                document.getElementById("previewImage").src = '';

                document.getElementById('inputImage').value = '';

                var parser = new DOMParser();
                var body = parser.parseFromString("{{$body}}", "text/html").body.textContent;
                var title = parser.parseFromString("{{$title}}", "text/html").body.textContent;

                document.getElementById("title").value = title;
                document.getElementById("body").value = body;
                document.getElementById("deleteOldImage").value = "false";
            }

            function funcDeleteImage() {
                document.getElementById("oldImage").style.visibility = "hidden";
                document.getElementById("oldImage").src = '';

                document.getElementById("previewImage").src = '';
                document.getElementById("previewImage").style.visibility = "hidden";

                document.getElementById('inputImage').value = '';
                document.getElementById("deleteOldImage").value = "true";
            }
        </script>
    @else
        <script>
            document.getElementById('inputImage').onchange = evt => {
                const [file] = document.getElementById('inputImage').files;
                if (file) {
                    document.getElementById("previewImage").style.visibility = "visible";
                    document.getElementById('previewImage').src = URL.createObjectURL(file);
                }
            }

            function balik() {

                document.getElementById("previewImage").style.visibility = "hidden";
                document.getElementById("previewImage").src = '';

                document.getElementById('inputImage').value = '';

                var parser = new DOMParser();
                var body = parser.parseFromString("{{$body}}", "text/html").body.textContent;
                var title = parser.parseFromString("{{$title}}", "text/html").body.textContent;

                document.getElementById("title").value = title;
                document.getElementById("body").value = body;
            }

            function funcDeleteImage() {
                document.getElementById("previewImage").src = '';
                document.getElementById("previewImage").style.visibility = "hidden";

                document.getElementById('inputImage').value = '';
            }
        </script>
    @endif
    @include('bootstrap.script')
</body>

</html>
