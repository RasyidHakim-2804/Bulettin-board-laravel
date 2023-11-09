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
    <title>Detail</title>
</head>

<body style=" background-color:#bab7b7">
    {{-- navbar --}}
    @include('bootstrap.navbar')
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
                        @if (auth()->id() === $post['user_id'])
                            <a href="/posts/{{ $post['id'] }}/edit" class="card-link text-decoration-none">Edit</a>
                            <form action="/posts/{{ $post['id'] }}" method="POST"id="deletePost-{{ $post['id'] }}">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:deletePost('{{ $post['id'] }}')"
                                    class="card-link text-decoration-none">Delete</a>
                            </form>
                        @endif
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

            {{-- ini from comment section --}}
            <div class="col-8 col-lg-8 col-sm-12 mt-3">
                <div class="row-1">
                    {{-- start comment form --}}
                    <form action="/comments" class="shadow p-4 mb-1 bg-body-tertiary rounded" method="post">
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
                <div class="container-fluid bg-white shadow p-4 mb-3 bg-body-tertiary rounded">

                    @isset($comments)
                        @foreach ($comments as $comment)

                            {{-- card comment --}}
                            <div class="card w-100 mb-1">
                                <div class="card-header">
                                    <div class="float-start me-2">
                                        <img src="https://picsum.photos/id/177/50" alt="profile" style="border-radius:50%">
                                    </div>
                                    <div class="mt-1">
                                        <h6 class="card-subtitle">{{ $comment->user->user_name }}</h6>
                                        <h6 class="card-subtitle my-1 text-muted">Update At:{{ \Carbon\Carbon::parse($comment->updated_at)->diffForHumans() }}</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p class="card-text" id="body-{{ $comment->id }}">{{ $comment->body }}</p>

                                    {{-- cek jika komen ini adalah milik user terautentikasi saat ini --}}
                                    @if (auth()->id() === $comment->user->id)
                                        
                                    {{-- form edit comment --}}
                                        <form action="/comments/{{ $comment->id }}" method="POST" id="update-{{ $comment->id }}" class="mb-2 hidden">
                                            @method('PUT')
                                            @csrf
                                            <input type="text" name="body" value="{{ $comment->body }}" class="form-control mb-1">
                                            <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                                            <a href="javascript:update('{{ $comment->id }}')" class="card-link text-decoration-none">Save</a>
                                        </form>
                                    {{-- end edit form --}}
                                        <a href="javascript:editComment('{{ $comment->id }}')"class="card-link text-decoration-none">Edit</a>
                                        <form action="/comments/{{ $comment->id }}"method="POST" id="deleteComment-{{ $comment->id }}">
                                            
                                            @csrf
                                            @method('DELETE')

                                            <a href="javascript:deleteComment('{{ $comment->id }}')"class="card-link text-decoration-none">Delete</a>
                                        </form>
                                    @endif
                                </div>
                                {{-- end card body --}}
                            </div>
                            {{-- end card comment --}}

                        @endforeach
                    @endisset
                </div>
            </div>

        </div>
    </div>




    {{-- script --}}
    @include('bootstrap.script')
    <script>
        function updateComment(id) {
            document.getElementById(`update-${id}`).submit();
        }

        function deleteComment(id) {
            const sure = confirm('Are you sure want to delete this comment?');
            if (sure) {
                document.getElementById(`deleteComment-${id}`).submit();
            }
        }

        function deletePost(id) {
            const sure = confirm('Are you sure want to delete this Post?');
            if (sure) {
                document.getElementById(`deleteComment-${id}`).submit();
            }
        }

        function editComment(id) {
            var form = document.getElementById(`update-${id}`);
            var body = document.getElementById(`body-${id}`);

            if (form.classList.contains("hidden")) {

                form.classList.remove("hidden");
                body.classList.add("hidden");
            } else {

                form.classList.add("hidden");
                body.classList.remove("hidden");
            }
        }
    </script>
</body>

</html>
