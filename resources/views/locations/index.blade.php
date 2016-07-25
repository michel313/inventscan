@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>All Locations</h1>
    </div>
    <div class="col-md-2">
      <a href="{{ url('/locations/new') }}" class="btn btn-primary pull-right">Add new location</a>
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
                          <th>Location ID</th>
                          <th>Shortcode</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($locations as $location)
                          <tr>
                            <td><a href="/locations/{{ $location->id}}/edit">{{ $location->location_id }}</a></td>
                            <td>{{ $location->shortcode }}</td>
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
