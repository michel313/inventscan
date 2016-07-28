@extends('layouts.app')



@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include ('partials.form_errors')
                <div class="panel panel-default">
                    <div class="panel-heading">Import CSV file</div>
                    <div class="panel-body">


                        {!! Form::open(array('url' => 'products/import', 'method' => 'post','files' => true)) !!}

                                <input type="file" name="import_file_csv" />
                                <br>
                                <button class="btn btn-primary">Import File</button>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection