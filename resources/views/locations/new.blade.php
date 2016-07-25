@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New Location</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/locations" method="post">
                    <div class="form-group">
                      <label for="">Location ID</label>
                      <input type="text" name="location_id" value="{{ old('location_id') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Shortcode</label>
                      <input type="text" name="shortcode" value="{{ old('shorcode') }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Save location" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
