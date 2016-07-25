@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Category</div>

                <div class="panel-body">
                  @include ('partials.form_errors')
                  <form class="" action="/categories/{{ $category->id }}" method="post">
                    {{ method_field('patch') }}
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" value="{{ $category->title }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <input type="submit" value="Update category" class="btn btn-primary">
                    </div>
                    {{ csrf_field() }}
                  </form>
                  <div class="pull-right">
                    <form class="" action="/categories/{{ $category->id }}" method="post">
                      {{ method_field('delete') }}
                      {{ csrf_field() }}
                      <input type="submit" value="Delete category" class="btn btn-danger">
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
