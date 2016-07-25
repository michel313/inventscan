@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Supplier</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/suppliers/{{ $supplier->id }}" method="post">
                    {{ method_field('patch') }}
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" value="{{ $supplier->title }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="">Shortcode <small>(optional)</small></label>
                      <input type="text" name="shortcode" value="{{ $supplier->shortcode }}" class="form-control">
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update supplier" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>
                  <div class="pull-right">
                    <form class="" action="/suppliers/{{ $supplier->id }}" method="post">
                      {{ method_field('delete') }}
                      {{ csrf_field() }}
                      <input type="submit" value="Delete supplier" class="btn btn-danger">
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
