@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>All Subcategories</h1>
    </div>
    <div class="col-md-2">
      <a href="{{ url('/subcategories/new') }}" class="btn btn-primary pull-right">Add new subcategory</a>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Title</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($subcategories as $subcategory)
                          <tr>
                            <td><a href="/subcategories/{{ $subcategory->id}}/edit">{{ $subcategory->title }}</a></td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
