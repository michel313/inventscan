@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>All Categories</h1>
    </div>
    <div class="col-md-2">
      <a href="{{ url('/categories/new') }}" class="btn btn-primary pull-right">Add new category</a>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div>
    <div class="row">
        <div class="col-md-12">
            @if(count($categories))
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Title</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $category)
                          <tr>
                            <td><a href="/categories/{{ $category->id}}/edit">{{ $category->title }}</a></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
            @else
                <h2 class="no-information"><i>No Information yet</i></h2>
            @endif
        </div>
    </div>
</div>
@endsection
