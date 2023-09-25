<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bulletin Board</title>
  <style>
    th, td {
      padding: 15px;
    }
    table, th, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
  </style>
</head>
<body>
  <div class="nav">
    <form action="/logout" method="GET">
      <button type="submit">Logout</button>
    </form>
    <div class="link">
      <a href="/home">Home</a>
    </div>
  </div>
  
  <div class="message">
    @if(session('message'))
      <h3> {{session('message')}} </h3>
    @endif
  </div>

  {{-- error --}}
  <div class="error">
    @if ($errors->any())
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>        
        @endforeach
      </ul>
    @endif
  </div>
 
  <h4>Your message must be 10 to 200 characters long</h4>
  <h4>Spaces at the beginning and at the end of a sentence are not counted</h4>
  <div>
    <form action="/post" method="POST">
    @csrf
      <textarea name="post_contents" cols="70" rows="3" style="resize:none"></textarea><br />
      <input type="submit" name="submit" value="Submit">
    </form>
    <input type="button" value="Refresh" onclick="refresh()">
  </div>
  <hr><br><br>

  <!-- show data -->
  <div>
    <table style="width: 70%;">
      <tr>
        <th>ID</th>
        <th>MESSAGE</th>
        <th>CREATED AT</th>
        <th>UPDATED AT</th>
        <th>ACTIONS</th>
      </tr>
    @foreach ($posts as $post)
      <tr>
        <td>{{$post->id}}</td>
        <td>{{$post->posts_contents}}</td>
        <td>{{$post->created_at}}</td>
        <td>{{$post->updated_at}}</td>
        <td>
          <input type="button" value="Edit" onclick="toEdit({{$post->id}})">
          <input type="button" value="Delete" onclick="myDelete({{$post->id}})">
        </td>
      </tr>
    @endforeach  
    </table>
    
  </div>
  <script>
    function toEdit(id){
      window.location =`/edit/${id}`;
    }

    function myDelete(id){
      const response = confirm('Are you sure want to delete it?');
      if(response){
        window.location = `/delete/${id}`;
      }
    }

    function refresh(){
      location.reload();
    }
  </script>
</body>
</html>
