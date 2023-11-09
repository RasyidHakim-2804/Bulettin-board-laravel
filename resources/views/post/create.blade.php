<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('bootstrap.link')
    <style>
        .hidden {
            display: none;
        }
    </style>
    <title>Document</title>
</head>

<body style=" background-color:#bab7b7">
    {{-- navbar --}}@include('bootstrap.navbar', ['create' => true])

    {{-- error --}} @include('bootstrap.error')

    <div class="container text-left border-primary p-3 mt-3 position-relative">
        <p>Your message must be 10 to 200 characters long</p>
        <p>Spaces at the beginning and at the end of a sentence are not counted</p>

        <form action="/posts" method="POST" enctype="multipart/form-data"
            class="shadow p-4 mb-3 bg-body-tertiary rounded">
            @csrf
            <div class="mb-3">
                <label for="title" class="from-label">Title:</label>
                <input type="text" name="title" class="form-control" id="title">
            </div>
            <div class="mb-3">
                <label for="body" class="from-label">Content:</label>
                <textarea name="body" rows="3" style="resize:none" id="body" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image: (optional)</label>
                <input class="form-control" type="file" id="inputImage" name="image" accept="image/png, image/gif, image/jpeg">
                <p>Your image:</p>
                <img src="" alt="preview" class="img-fluid hidden" id="previewImage">
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
            <input type="button" value="Reset" class="btn btn-primary" onclick="balik()">
        </form>
    </div>

    {{-- cript --}}@include('bootstrap.script')
    <script>
        document.getElementById('inputImage').onchange = evt => {
            const [file] = document.getElementById('inputImage').files;
            if (file) {
                document.getElementById("previewImage").classList.remove('hidden');
                document.getElementById('previewImage').src = URL.createObjectURL(file);
            }
        }

        function balik() {
            document.getElementById('title').value = '';
            document.getElementById('body').value = '';
            document.getElementById('inputImage').value = '';
            document.getElementById('previewImage').classList.add('hidden');
        }
    </script>
</body>

</html>
