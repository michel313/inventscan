@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Subcategory</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/subcategories/{{ $subcategory->id }}" method="post">
                    {{ method_field('patch') }}
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" value="{{ $subcategory->title }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update subcategory" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>
                  <div class="pull-right">
                    <form class="" action="/subcategories/{{ $subcategory->id }}" method="post">
                      {{ method_field('delete') }}
                      {{ csrf_field() }}
                      <input type="submit" value="Delete subcategory" class="btn btn-danger">
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
