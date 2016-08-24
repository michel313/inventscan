@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>All Servers</h1>
    </div>
    <div class="col-md-2">
      <a href="{{ url('/servers/create') }}" class="btn btn-primary pull-right">Add new server</a>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
  </div>
    <div class="row">
        <div class="col-md-12">
            @if(count($servers))
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Location ID</th>
                          <th>Type</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($servers as $server)
                          <tr>
                            <td>{{ $server->location_id }}</td>
                            <td>{{ $server->type }}</td>
                          <td class="text-right">

                              <a href="/servers/{{ $server->id}}/edit" class="btn edit-check"> <i class="fa fa-pencil"></i>
                              </a>

                              <a href="javascript:void(0)" class="btn remove-cancel  deleteAjax"
                                 data-token="{{ csrf_token() }}"
                                 data-type="deleteServer"
                                 data-id="{!! $server->id !!}">
                                  <i class="fa fa-remove"></i>
                              </a>

                          </td>
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
