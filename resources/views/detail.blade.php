<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('bootstrap.link')
    <title>Detail</title>
</head>

<body style=" background-color:#bab7b7">
    {{-- navbar --}}
    @include('bootstrap.navbar', ['dashboard' => true])
    {{-- end navbar --}}

    {{-- error --}}@include('bootstrap.error')

    {{-- succes --}}@include('bootstrap.success')

    <div class="container-fluid mb-4">
        <div class="row">
            {{-- ini detail section --}}
            <div class="col-8 col-lg-8 col-sm-12 ">
                {{-- start card --}}
                <div class="card w-100">
                    {{-- card head --}}
                    <div class="card-header">
                        <div class="float-start me-2">
                            <img src="https://picsum.photos/id/177/50" alt="profile" style="border-radius:50%">
                        </div>
                        <div class="mt-1">
                            <h6 class="card-subtitle">{{ $post['user_name'] }}</h6>
                            <h6 class="card-subtitle my-1 text-muted">Update At:
                                {{ \Carbon\Carbon::parse($post['updated_at'])->diffForHumans() }}</h6>
                        </div>
                    </div>
                    {{-- card body --}}
                    <div class="card-body">
                        <h4 class="card-title">{{ $post['title'] }}</h4>
                        <p class="card-text">{{ $post['body'] }}</p>
                    </div>
                    {{-- image --}}
                    @if ($photo)
                        <div class="img-container">
                            <img src="{{ url('/storage/user/post/' . $photo) }}" class="card-img-top img-fluid">
                        </div>
                    @endif

                </div>
                {{-- end card --}}
            </div>
            {{-- ini comment section --}}
            <div class="col-8 col-lg-8 col-sm-12 mt-3">
                <div class="row-1">
                    {{-- start comment form --}}
                    <form action="/comments" class="shadow p-4 mb-1 bg-body-tertiary rounded" method="POST">
                        @csrf
                        <div class="mb-2">
                            <h2>Comments</h2>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="from-label">Your Comment:</label>
                            <input type="text" name="body" class="form-control">
                            <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                        </div>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                        <input type="reset" value="Reset" class="btn btn-primary">
                    </form>
                    {{-- end comments form --}}
                </div>
            </div>
            {{-- show comments --}}
            <div class="col-8 col-lg-8 col-sm-12 mt-1">
                <div class="container bg-white shadow p-4 mb-3 bg-body-tertiary rounded">
                    @isset($comments)
                        @foreach ($comments as $comment)
                            <div class="card w-100 mb-1">
                                <div class="card-header">
                                    <div class="float-start me-2">
                                        <img src="https://picsum.photos/id/177/50" alt="profile" style="border-radius:50%">
                                    </div>
                                    <div class="mt-1">
                                        <h6 class="card-subtitle">{{ $comment->user->user_name }}</h6>
                                        <h6 class="card-subtitle my-1 text-muted">Update At:
                                            {{ \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() }}</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ $comment->body }}
                                    </p>
                                    @if (auth()->id() === $comment->user->id)
                                        <a href="/comments/{{ $comment->id }}/edit"
                                            class="card-link text-decoration-none">Edit</a>
                                        <form action="/comments/{{ $comment->id }}"
                                            method="POST"id="delete-{{ $comment->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#"class="card-link text-decoration-none"
                                                onclick="deletePost('{{ $comment->id }}')">Delete</a>
                                    @endif
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
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
    </script>
</body>

</html>
