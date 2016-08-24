@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">New Export Path</div>
                    <div class="panel-body">

                        @include('partials/form_errors')

                        {!! Form::open(array('url' => '/export-path', 'method' => 'post')) !!}
                        <div class="form-group">
                            <label id="path">Path</label>
                            <input placeholder="/app/export/products" class="form-control" name="path" type="text" id="path" >
                        </div>

                        <button class="btn btn-primary">Create</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
