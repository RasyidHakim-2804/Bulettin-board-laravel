<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('bootstrap.link')
    <title>Home</title>
</head>

<body style=" background-color:#bab7b7">
    {{-- navbar --}}
    @include('bootstrap.navbar', ['home' => true])
    {{-- end navbar --}}

    <div class="container my-4">
        <div class="row">
            {{-- main content --}}
            <div class="col-lg-8 col-sm-12">
                <div class="row g-2">
                    @include('component/card-post', ['posts' => $posts])
                </div>
            </div>
            {{-- side content --}}
            <div class="col-lg-3 col-sm-12">
                <h1>Ini side bar</h1>
            </div>
        </div>
    </div>

    {{-- paginator --}}
    <div>
        {{ $posts->links('vendor.pagination.bootstrap-5') }}
    </div>

    @include('bootstrap.script')
</body>

</html>
