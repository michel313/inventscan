@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Update Export Paths</h1>
                <hr>

            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">


                {!! Form::open(array('url' => '/export-paths/update', 'method' => 'post')) !!}

                <div class="form-group">
                    <label for="product-path">Product path</label>
                    <input id="product-path" type="text" name="product" value="{{$path->paths->product}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="location-path">Location path</label>
                    <input type="text" id="location-path" name="location" value="{{$path->paths->location}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="service-path">Service path</label>
                    <input type="text" id="service-path" name="server" value="{{$path->paths->server}}" class="form-control">
                </div>


                <button class="btn btn-primary">Update</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
