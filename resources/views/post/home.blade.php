<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <style>
    th, td {
      padding: 15px;
    }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
  <title>Home</title>
</head>
<body>
  {{-- navbar --}}
  <div class="nav">
    @auth
    <input type="button" value="Logout" onclick="(function(){window.location = '/logout'})()">
    @endauth

    @guest
    <input type="button" value="Login" onclick="(function(){window.location = '/login'})()">
    @endguest
    <input type="button" value="Post" onclick="(function(){window.location = '/post'})()">
  </div>
  <div>
    <table style="width: 70%;">
      <tr>
        <th>ID</th>
        <th>MESSAGE</th>
        <th>UPADTED AT</th>
        <th>AUTHOR</th>
      </tr>
    @foreach ($posts as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->posts_contents}}</td>
        <td>{{$post->updated_at}}</td>
        <td>{{$post->author->user_name}}</td>
      </tr>
    @endforeach  
    </table>
    <div class="pagination">
      {{ $posts->links() }}
    </div>
  </div>  
</body>
</html>