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
            @if(count($suppliers))
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Title</th>
                          <th>Shortcode</th>
                          <th>CSV</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($suppliers as $supplier)
                          <tr>
                            <td>{{ $supplier->title }}</td>
                            <td>{{ $supplier->shortcode }}</td>
                            <td><a href="{{url('supplier/'.$supplier->id.'/import/csv')}}">Import CSV</a> </td>
                              <td class="text-right">

                                  <a href="/suppliers/{{ $supplier->id}}/edit" class="btn edit-check"> <i class="fa fa-pencil"></i>
                                  </a>

                                  <a href="javascript:void(0)" class="btn remove-cancel  deleteAjax"
                                     data-token="{{ csrf_token() }}"
                                     data-type="deleteSupplier"
                                     data-id="{!! $supplier->id !!}">
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
