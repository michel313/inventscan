@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1>All Export Paths</h1>
            </div>
            <div class="col-md-2">
                <a href="{{ url('export-path/create') }}" class="btn btn-primary pull-right">Add new path</a>
            </div>
            <div class="col-md-12">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">

                @if(count($paths))
                <div class="panel panel-default">
                    <div class="panel-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Path</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($paths as $path)
                                    <tr>
                                        <td>{{$path->path}}</td>
                                        <td class="text-right">

                                            <a href="/export-path/{{ $path->id}}/edit" class="btn edit-check"> <i class="fa fa-pencil"></i></a>

                                            <a href="javascript:void(0)" class="btn remove-cancel  deleteAjax"
                                               data-token="{{ csrf_token() }}"
                                               data-type="deletePath"
                                               data-id="{!! $path->id !!}">
                                                <i class="fa fa-remove"></i>
                                            </a>

                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
                @else
                    <h2><i>No Information</i></h2>
                @endif

            </div>
        </div>
    </div>
@endsection
