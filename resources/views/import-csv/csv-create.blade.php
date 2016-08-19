@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-10 col-md-offset-1">
                @include ('partials.form_errors')

                <div class="panel panel-default">
                    @if(empty($data))

                        @include ('import-csv.csv-file-import')

                    @else

                        @include ('import-csv.csv-import-form-selects')

                     @endif
                </div>
            </div>
        </div>
    </div>



@endsection


