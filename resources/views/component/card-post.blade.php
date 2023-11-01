{{-- if content is null --}}
@if ($posts->all() === [])
    <div class="col">
        <div class="card w-100" style="width: 18.5rem">
            <div class="card-body">
                <h5 class="card-title">NULL</h5>
                <h6 class="card-subtitle my-1 text-muted">EMPYT</h6>
                <p class="card-text overflow-hidden" style="height: 6rem">Sorry, the post still
                    empty.
                    Please create the post</p>
            </div>
        </div>
    </div>
@else
    {{-- if content not null --}}
    @foreach ($posts as $post)
        <div class="col-12">
            {{-- start card --}}
            <div class="card w-100">
                {{-- card head --}}
                <div class="card-header">
                    <div class="float-start me-2">
                        <img src="https://picsum.photos/id/177/50" alt="profile" style="border-radius:50%">
                    </div>
                    <div class="mt-1">
                        <h6 class="card-subtitle">{{ $post->user->user_name }}</h6>
                        <h6 class="card-subtitle my-1 text-muted">Update At:
                            {{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</h6>
                    </div>
                </div>
                {{-- card body --}}
                <div class="card-body">
                    <h4 class="card-title">{{ $post->title }}</h4>
                    <p class="card-text overflow-hidden" style="height: 6rem">{{ $post->body }}</p>
                    <a href="/posts/{{ $post->id }}" class="card-link text-decoration-none">Detail</a>
                    @isset($dashboard)
                        <a href="/posts/{{ $post->id }}/edit" class="card-link text-decoration-none">Edit</a>
                        <form action="/posts/{{ $post->id }}" method="POST"id="delete-{{ $post->id }}">
                            @csrf
                            @method('DELETE')
                            <a href="#"
                                class="card-link text-decoration-none"onclick="deletePost('{{ $post->id }}')">Delete</a>
                        </form>
                    @endisset
                </div>
                {{-- image --}}
                @if ($post->photo)
                    <div class="img-container" style="height: 300px; overflow: hidden;">
                        <img src="{{url('/storage/user/post/'.$post->photo->title )}}" class="card-img-top img-fluid">
                    </div>
                @endif

            </div>
            {{-- end card --}}
        </div>
    @endforeach
@endif
