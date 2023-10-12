<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @include('bootstrap.link')
  <title>Document</title>
</head>
<body>
   {{-- navbar --}}@include('bootstrap.navbar',['dashboard' => true])

  {{-- error --}} @include('bootstrap.error')

  <div class="container text-left border-primary p-3 mt-3 position-relative">
    <p>Your message must be 10 to 200 characters long</p>
    <p>Spaces at the beginning and at the end of a sentence are not counted</p>

    <form action="/posts" method="POST" class="shadow p-4 mb-3 bg-body-tertiary rounded">
    @csrf
      <div class="mb-3">
        <label for="title" class="from-label">Title:</label>
        <input type="text" name="title" class="form-control">
      </div>
      <div class="mb-3">
        <label for="body" class="from-label">Content:</label>
        <textarea name="body" rows="3" style="resize:none" class="form-control"></textarea>
      </div>
      <input type="submit" name="submit" value="Submit" class="btn btn-primary">
      <input type="reset" value="Reset" class="btn btn-primary">
    </form>
  </div>

  {{-- cript --}}@include('bootstrap.script')
</body>
</html>