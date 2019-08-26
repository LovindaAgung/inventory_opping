@if(Auth::guard('web')->check())
  <p class="text-success">
    Logged as USER
  </p>
@else
  <p class="text-danger">
    USER Logged Out !
  </p>
@endif

@if(Auth::guard('admin')->check())
  <p class="text-success">
    Logged as ADMIN
  </p>
@else
  <p class="text-danger">
    ADMIN Logged Out !
  </p>
@endif
