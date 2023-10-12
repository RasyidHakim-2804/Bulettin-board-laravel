<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @include('bootstrap.link')
  <title>Bulletin Board</title>
</head>
<body style=" background-color:#bab7b7">

  {{-- navbar --}}@include('bootstrap.navbar',['dashboard' => false])

  {{-- error --}}@include('bootstrap.error')

  {{-- succes --}}@include('bootstrap.success')

  {{-- if data empty --}}
  <div class="container my-4">
    <div class="row row-cols-1 row-cols-md-1 g-2">
      @if ($posts->all() === [])
      <div class="col">
        <div class="card w-100" style="width: 18.5rem">
          <div class="card-body">
            <h5 class="card-title">NULL</h5>
            <h6 class="card-subtitle my-1 text-muted">EMPTY</h6>
            <p class="card-text overflow-hidden" style="height: 6rem">Sorry, the post still empty. Please create the post</p>
          </div>
        </div>
      </div>    
      @endif
    </div>
  </div>

  <!-- show data -->

  <div class="container mb-5">
    {{$posts->links('vendor.pagination.bootstrap-5')}}
    <div class="row row-cols-1 row-cols-md-1 g-2">
      @foreach ($posts as $post)
      <div class="col">
        <div class="card w-100" style="width: 18.5rem">
          <div class="card-body">
            <h5 class="card-title">Title: {{$post->title}}</h5>
            <p class="card-subtitle my-1 text-muted">Update At: {{date('d-m-Y', strtotime($post->updated_at))}}</p>
            <h6 class="card-text overflow-hidden" style="height: 6rem">{{$post->body}}</h6>
            <a href="/posts/{{$post->id}}/edit" class="card-link text-decoration-none">Edit</a>
            <form action="/posts/{{$post->id}}" method="POST" id="delete-{{$post->id}}">
              @csrf
              @method('DELETE')
              <a href="#" class="card-link text-decoration-none" onclick="deletePost({{$post->id}})">Delete</a>
            </form>
          </div>
        </div>
      </div>
      @endforeach
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
