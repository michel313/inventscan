@if (count($errors))
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li><strong>{{ $error }}</strong></li>
      @endforeach
    </ul>
  </div>
@endif

<div class="ajax-errors"></div>

@if(Session::has('error_message'))
  <h5 class="alert alert-danger"><b>{!!   Session::get('error_message')!!}</b></h5>
@endif

