@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Location</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/locations/{{ $location->id }}" method="post">
                    {{ method_field('patch') }}
                    <div class="form-group">
                      <label for="">Location ID</label>
                      <input type="text" name="location_id" value="{{ $location->location_id }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Shortcode</label>
                      <input type="text" name="shortcode" value="{{ $location->shortcode }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update location" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>
                  <div class="pull-right">
                    <form class="" action="/locations/{{ $location->id }}" method="post">
                      {{ method_field('delete') }}
                      {{ csrf_field() }}
                      <input type="submit" value="Delete location" class="btn btn-danger">
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
