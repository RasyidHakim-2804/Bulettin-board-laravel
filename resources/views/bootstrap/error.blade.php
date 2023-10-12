@if ($errors->any())
    <div class="position-relative mt-3 mx-3">
    @foreach ($errors->all() as $error)
      <div class="alert alert-danger p-3 text-center position-relative top-0 start-50 translate-middle-x" role="alert">{{$error}}
        <button type="button" class="btn-close" aria-label="Close"></button>
      </div>        
    @endforeach
    </div>
  @endif