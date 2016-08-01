@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                @include ('partials.form_errors')
                <div class="panel panel-default">
                    @if(empty($data))

                        <div class="panel-heading">Import CSV file</div>
                        <div class="panel-body">
                            {!! Form::open(array('url' => 'products/import/csv', 'method' => 'post','files' => true)) !!}

                                    <input type="file" name="import_file_csv" />
                                    <br>
                                    <button class="btn btn-primary">Import File</button>

                            {!! Form::close() !!}
                        </div>

                    @else

                        <div class="panel-body csv-part">
                            {!! Form::open(array('url' => 'products/import/store', 'method' => 'post','files' => true)) !!}

                            <input type="hidden" name="fileName" value="{{$data['fileName']}}">
                            <table class="table">
                               <thead>
                                    <tr>
                                        <th>Database Row</th>
                                        <th>CSV Row</th>
                                    </tr>
                                </thead>

                                @foreach($data['fillProducts'] as $fills)
                                    <tbody>
                                        <tr>
                                            <td>{{$fills}}</td>
                                            <td>

                                                <select class="form-control" multiple name="{{$fills}}[]">
                                                    @if(!empty($data['columnsNames']) )
                                                        @foreach($data['columnsNames'] as $columnsNumber => $columnsName)
                                                            <option value="{{$columnsNumber}}">{{$columnsName}}</option>
                                                        @endforeach
                                                    @endif
                                                </select>




                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach

                            </table>

                            <button class="btn btn-primary">Import Csv</button>

                            {!! Form::close() !!}
                        </div>


                     @endif
                </div>
            </div>
        </div>
    </div>



@endsection


