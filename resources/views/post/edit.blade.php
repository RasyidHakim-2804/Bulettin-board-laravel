<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit/{{$id}}</title>
</head>
<body>
  {{-- error jika ada vlidate yang gagagl --}}
  <div class="error">
    @if ($errors->any())
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>        
        @endforeach
      </ul>
    @endif
  </div>
 
  <form action="/edit/{{$id}}" method="post">
    @csrf
    <textarea name="post_contents" cols="70" rows="3" style="resize:none">{{$message}}</textarea><br />
    <input type="submit" name="submit" value="Submit">
  </form>
  <input type="button" value="Cancel" onclick="toPost()">

  <script>
    function toPost() {
      window.location = '/post';
    }
  </script>
</body>
</html>