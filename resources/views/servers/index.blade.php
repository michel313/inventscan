@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>All Servers</h1>
    </div>
    <div class="col-md-2">
      <a href="{{ url('/servers/new') }}" class="btn btn-primary pull-right">Add new server</a>
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
                          <th>Type</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($servers as $server)
                          <tr>
                            <td><a href="/servers/{{ $server->id}}/edit">{{ $server->location_id }}</a></td>
                            <td>{{ $server->type }}</td>
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
