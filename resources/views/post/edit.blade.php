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
  <div  class="container text-left border-primary p-3 mt-5 w-75">
    <form action="/edit/{{$post->id}}" method="post" class="shadow p-4 mb-3 bg-body-tertiary rounded">
      @csrf
      <div class="mb-5">
        <h3>Edit</h3>
      </div>
      <div class="mb-3">
        <label for="title" class="from-label">Title:</label>
        <input type="text" name="title" class="form-control" value="{{$post->title}}">
      </div>
      <div class="mb-3">
        <label for="post_contents" class="from-label">Content:</label>
        <textarea name="body" rows="3" style="resize:none" class="form-control">{{$post->body}}</textarea>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        <input type="reset" value="Reset" class="btn btn-primary">
        <input type="button" value="Cancel" onclick="toPost()" class="btn btn-danger">
      </div>
    </form>  
  </div>
  
  <script>
    function toPost() {
      window.location = '/post';
    }
  </script>
  @include('bootstrap.script')
</body>
</html>