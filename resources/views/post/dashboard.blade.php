<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('bootstrap.link')
    <title>Bulletin Board</title>
</head>

<body style=" background-color:#bab7b7">

    {{-- navbar --}}@include('bootstrap.navbar', ['dashboard' => false])

    {{-- error --}}@include('bootstrap.error')

    {{-- succes --}}@include('bootstrap.success')

    <div class="container text-center">
        <h1>Your Posts</h1>
    </div>

    

    <!-- show data -->

    <div class="container mb-5">
        {{ $posts->links('vendor.pagination.bootstrap-5') }}
        <div class="row">
            {{-- main content --}}
            <div class="col-lg-8 col-sm-12">
                <div class="row g-2">
                    @include('.../component/card-post', ['posts'=> $posts, 'dashboard'=>true])
                </div>
            </div>

            {{-- side content --}}
            <div class="col-lg-3 col-sm-12">
                <h1>Ini side bar</h1>
            </div>
        </div>
    </div>

    @include('bootstrap.script')
    <script>
        function deletePost(id) {
            const sure = confirm('Are you sure?');
            if (sure) {
                document.getElementById(`delete-${id}`).submit();
            }
        }

        function test() {
            const sure = confirm('Are you sure?');
        }
    </script>
</body>

</html>
