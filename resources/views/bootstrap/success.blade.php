<div class="position-relative mt-3 mx-3">
  @if(session('message'))
    <div class="alert alert-success p-3 text-center position-relative top-0 start-50 translate-middle-x" role="alert">{{session('message')}}</div> 
  @endif
</div>