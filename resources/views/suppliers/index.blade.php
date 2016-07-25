@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-10">
        <h1>All Suppliers</h1>
      </div>
      <div class="col-md-2">
        <a href="{{ url('/suppliers/new') }}" class="btn btn-primary pull-right">Add new supplier</a>
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
                          <th>Shortcode</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($suppliers as $supplier)
                          <tr>
                            <td><a href="/suppliers/{{ $supplier->id}}/edit">{{ $supplier->title }}</a></td>
                            <td>{{ $supplier->shortcode }}</td>
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
