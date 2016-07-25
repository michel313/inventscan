@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">New Supplier</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/suppliers" method="post">
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" value="{{ old('title')}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Shortcode <small>(optional)</small></label>
                      <input type="text" name="shortcode" value="" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Save supplier" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
